<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ReportController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'phone_number' => 'nullable|string',
                'address' => 'required|string',
                'lga' => 'required|string',
                'area' => 'required|string',
                'waste_type' => 'required|string',
                'message' => 'nullable|string',
                'captured_image' => 'required|string', // For base64 data
                'latitude' => 'required|string',
                'longitude' => 'required|string',
            ]);

            $base64Image = $request->input('captured_image');

            // Validate and process the base64 image
            if (!preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                throw new Exception('Invalid base64 image data.');
            }

            $imageData = explode(';base64,', $base64Image);
            $imageExtension = $type[1]; // Extract image type (e.g., png, jpeg)
            $imageBase64 = $imageData[1];

            // Alternative method for detecting MIME type if fileinfo is not available
            $tempFile = tempnam(sys_get_temp_dir(), 'img');
            file_put_contents($tempFile, base64_decode($imageBase64));
            $mimeType = mime_content_type($tempFile);
            unlink($tempFile);

            // Determine the file extension from MIME type
            $mimeToExtension = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
                // Add other MIME types as needed
            ];

            $imageExtension = $mimeToExtension[$mimeType] ?? 'jpg'; // Default to jpg if MIME type is unknown

            // Save the image to the storage
            $imageName = Str::random(10) . '-' . time() . '.' . $imageExtension;
            $imagePath = 'public/images/' . $imageName;

            Storage::disk('public')->put('images/' . $imageName, base64_decode($imageBase64));

            // Add the image path to validated data
            $validatedData['captured_image'] = 'storage/images/' . $imageName;

            // Store data
            Report::create($validatedData);

            return response()->json([
                'status' => true,
                'message' => 'Report created successfully.'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error.',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

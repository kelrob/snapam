<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            $image_data = preg_replace('#^data:image/\w+;base64,#', '', $base64Image);
            $image_type = explode('/', $image_data)[1];

            // Decode the base64 string
            $imageData = base64_decode($image_data);

            // Generate a unique filename
            $fileName = time() . '_' . uniqid() . '.' . $image_type;


            Storage::disk('public')->put($fileName, $imageData);

//            // Extract the base64 image data (remove prefix)
//            $imageData = explode(';base64,', $base64Image);
//            $imageExtension = explode('/', explode(':', $imageData[0])[1])[1];
//            $imageBase64 = $imageData[1];

            // Save the image to the storage
            // Generate a unique filename with timestamp
//            $imageName = Str::random(10) . '-' . time() . '.' . $imageExtension;
//            $imagePath = 'public/images/' . $imageName;
//            Storage::put($imagePath, base64_decode($imageBase64));

            // Add the image path to validated data
            $validatedData['captured_image'] = 'storage/' . $fileName;


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

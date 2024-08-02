<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        $lga = $request->query('lga');
        $area = $request->query('area');

        if ($area) {
            $reports = Report::where('area', $area)->get();
        } else if ($lga && $lga != 'All') {
            $reports = Report::where('lga', $lga)->get();
        } else {
            // Fetch reports in descending order
            $reports = Report::orderBy('created_at', 'desc')->get();
        }

        // Pass reports to the home view using compact
        return view('home', compact('reports', 'lga', 'area'));
    }

    public function reports(Request $request): Renderable
    {
        $lga = $request->query('lga');
        $area = $request->query('area');

        if ($area) {
            $reports = Report::where('area', $area)->paginate(10);
        } else if ($lga && $lga != 'All') {
            $reports = Report::where('lga', $lga)->paginate(10);
        } else {
            // Fetch reports in descending order
            $reports = Report::orderBy('created_at', 'desc')->paginate(10);
        }


        // Pass reports to the home view using compact
        return view('reports', compact('reports', 'lga', 'area'));
    }

    public function updateAction(Request $request, Report $report)
    {
        $request->validate([
            'action' => 'required|string|in:assigned,cleanup,completed',
        ]);

        // Update the report status based on the action
        switch ($request->input('action')) {
            case 'assigned':
                $report->status = 'Assigned';
                break;
            case 'cleanup':
                $report->status = 'Clean up in Progress';
                break;
            case 'completed':
                $report->status = 'Completed';
                break;
        }

        $report->save();

        return redirect()->back()->with('success', 'Report status updated successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $status = $request->query('status');

        if ($area) {
            $reports = Report::where('area', $area)->with('treatedBy')->get();
        } else if ($lga && $lga != 'All') {
            $reports = Report::where('lga', $lga)->with('treatedBy')->get();
        } else if ($status) {
            $reports = Report::where('status', $status)->with('treatedBy')->get();
        } else {
            // Fetch reports in descending order
            $reports = Report::orderBy('created_at', 'desc')->with('treatedBy')->get();
        }

        // Pass reports to the home view using compact
        return view('home', compact('reports', 'lga', 'area', 'status'));
    }

    public function reports(Request $request): Renderable
    {
        $lga = $request->query('lga');
        $area = $request->query('area');
        $status = $request->query('status');

        if ($area) {
            $reports = Report::where('area', $area)->with('treatedBy')->paginate(10);
        } else if ($lga && $lga != 'All') {
            $reports = Report::where('lga', $lga)->with('treatedBy')->paginate(10);
        } else if ($status) {
            $reports = Report::where('status', $status)->with('treatedBy')->paginate(10);
        } else {
            // Fetch reports in descending order
            $reports = Report::orderBy('created_at', 'desc')->with('treatedBy')->paginate(10);
        }

        // Pass reports to the home view using compact
        return view('reports', compact('reports', 'lga', 'area', 'status'));
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
        $report->treated_by = Auth::id();
        $report->save();

        return redirect()->back()->with('success', 'Report status updated successfully.');
    }

    public function report($report)
    {
        $reportInfo = Report::find($report);

        // Check if the report exists
        if (!$reportInfo) {
            abort(404, 'Report not found');
        }

        // Pass the report details to the view
        return view('report', compact('reportInfo'));
    }

    public function map($id)
    {
        $report = Report::find($id);
        return view('map', compact('report'));
    }
}

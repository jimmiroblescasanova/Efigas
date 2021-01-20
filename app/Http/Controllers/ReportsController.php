<?php

namespace App\Http\Controllers;

use App\Clients;
use App\Project;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function lectureReportParameters()
    {
        return view('reports.lecture.parameters', [
            'projects' => Project::all(),
        ]);
    }

    public function lectureReport(Request $request)
    {
        $project = Project::find($request->project_id);
        $clients = Clients::where('project_id', $project->id)->get();

        return view('reports.lecture.print', [
            'clients' => $clients,
        ]);
    }
}

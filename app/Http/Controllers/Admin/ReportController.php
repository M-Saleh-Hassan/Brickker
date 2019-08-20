<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Contact;
use App\Models\Report;

use Validator;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        
        return view('admin.reports.index')
        ->with('reports', $reports);
    }

    public function delete(Request $request)
    {
        $report = Report::find($request->id);
        $report->delete();
        return response()->json(array('id' => $request->id), 200);
    }


}

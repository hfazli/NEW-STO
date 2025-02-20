<?php
// filepath: /d:/STO-master/STO-master/app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Models\Report; // Import the Report model
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Fetch reports from the database
        $reports = Report::all();

        // Pass the reports to the view
        return view('sto.report', compact('reports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'part_name' => 'required|string',
            'part_number' => 'required|string',
            'inventory_id' => 'required|string',
            'status_product' => 'required|string',
            'qty_package' => 'required|integer',
            'qtybox' => 'required|integer',
            'total' => 'required|integer',
            'grand_total' => 'required|integer',
            'issue_date' => 'required|date',
            'prepared_by' => 'required|string',
            'checked_by' => 'required|string',
            'detail_lokasi' => 'required|string',
            'plant' => 'required|string',
        ]);

        Report::create($request->all());

        return redirect()->route('sto.report')->with('success', 'Data berhasil tersimpan');
    }
}
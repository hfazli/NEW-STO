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
        // Validasi data
        $validatedData = $request->validate([
            'qty_package' => 'required|numeric',
            'qtybox' => 'required|numeric',
            'total' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'issue_date' => 'required|date',
            'prepared_by' => 'required|string',
            'checked_by' => 'required|string',
            'detail_lokasi' => 'required|string',
            'detail_lokasi2' => 'nullable|string',
            'plant' => 'required|string',
            'id_card_number' => 'required|string',
        ]);

        // Simpan data ke database
        $report = new Report($validatedData);
        $report->save();

        // Redirect ke halaman laporan dengan pesan sukses
        return redirect()->route('reports.index')->with('success', 'Data berhasil tersimpan dan ditambahkan ke laporan.');
    }
}
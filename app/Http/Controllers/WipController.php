<?php
// filepath: /d:/PROJECT-STO - Copy/app/Http/Controllers/WipController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class WipController extends Controller
{
    public function showForm()
    {
        $inventory = Inventory::first(); // Ganti dengan logika yang sesuai untuk mendapatkan data inventory
        $user = auth()->user();
        $admin = Admin::first(); // Ganti dengan logika yang sesuai untuk mendapatkan data admin

        return view('STO.from-wip', compact('inventory', 'user', 'admin'));
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

        Inventory::create($request->all());

        return redirect()->route('reports.index')->with('success', 'Data berhasil tersimpan');
    }
}
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\User;
use App\Models\Admin;

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
            'issue_date' => 'required|date',
            'prepared_by' => 'required|string',
            'checked_by' => 'required|string',
            'qtybox' => 'required|integer',
        ]);

        $inventory = Inventory::find($request->inventory_id);
        if (!$inventory) {
            return redirect()->back()->with('notfound', 'Inventory not found');
        }

        $inventory->update([
            'issue_date' => $request->issue_date,
            'prepared_by' => $request->prepared_by,
            'checked_by' => $request->checked_by,
            'qtybox' => $request->qtybox,
            'total' => $request->qty_package * $request->qtybox,
            'grand_total' => $request->total + $request->total2,
        ]);

        return redirect()->route('reports.index')->with('success', 'Data berhasil tersimpan');
    }
}
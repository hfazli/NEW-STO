<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daily;
use App\Models\Customer;
use App\Models\Inventory; // Add this line to import the Inventory model
use App\Imports\InventoryImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF; // Ensure you have the barryvdh/laravel-dompdf package installed

class DailyController extends Controller
{
    public function index(Request $request)
    {
        $entries = $request->get('entries', 'all'); // Default to 'all' entries per page
        $search = $request->get('search'); // Get the search query

        $query = Daily::query();

        if ($search) {
            $query->where('customer', 'like', '%' . $search . '%');
        }

        if ($entries == 'all') {
            $daily = $query->get();
        } else {
            $daily = $query->paginate($entries);
        }

        return view('daily.index', compact('daily', 'search'));
    }

    public function create()
    {
        $inventory = Inventory::all(); // Assuming you have an Inventory model
        return view('Daily.create', compact('inventory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|string|max:255',
            'part_name' => 'required|string|max:255',
            'part_number' => 'required|string|max:255',
            'customer' => 'required|string|max:255',
            'min_stock' => 'required|integer',
            'max_stock' => 'required|integer',
            'actual_stock' => 'required|integer',
            'status_product' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $daily = new Daily();
        $daily->inventory_id = $request->inventory_id;
        $daily->part_name = $request->part_name;
        $daily->part_number = $request->part_number;
        $daily->customer = $request->customer;
        $daily->min_stock = $request->min_stock;
        $daily->max_stock = $request->max_stock;
        $daily->actual_stock = $request->actual_stock;
        $daily->status_product = $request->status_product;
        $daily->lokasi = $request->lokasi;
        $daily->date = $request->date;

        $daily->save();

        return redirect()->route('daily.index')->with('success', 'Daily stock created successfully.');
    }

    public function show($id)
    {
        $daily = Daily::findOrFail($id);
        return view('daily.show', compact('daily'));
    }

    public function edit($id)
    {
        $daily = Daily::findOrFail($id);
        $inventory = Inventory::all(); // Assuming you have an Inventory model
        return view('Daily.edit', compact('daily', 'inventory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'inventory_id' => 'required|string|max:255',
            'part_name' => 'required|string|max:255',
            'part_number' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'customer' => 'required|string|max:255',
            'min_stock' => 'required|integer',
            'max_stock' => 'required|integer',
            'actual_stock' => 'required|integer',
            'status_product' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $daily = Daily::findOrFail($id);
        $daily->update($request->all());

        return redirect()->route('daily.index')->with('success', 'Daily stock updated successfully.');
    }

    public function destroy($id)
    {
        $daily = Daily::findOrFail($id);
        $daily->delete();

        return redirect()->route('daily.index')->with('success', 'Daily stock deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        $import = new InventoryImport;
        Excel::import($import, $request->file('file'));

        if (count($import->getErrorRows()) > 0) {
            return redirect()->route('daily.index')->with('error', 'Some rows failed to import.');
        }

        return redirect()->route('daily.index')->with('success', 'Daily stock imported successfully.');
    }

    public function showUploadForm()
    {
        return view('daily.upload');
    }

    public function downloadPdf()
    {
        $dailies = Daily::all();
        $pdf = PDF::loadView('daily.pdf', compact('dailies'));
        return $pdf->download('daily.pdf');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');
        Excel::import(new InventoryImport, $file);

        return redirect()->route('daily.index')->with('success', 'Daily stock uploaded successfully.');
    }

    public function changeStatus($id, Request $request)
    {
        $daily = Daily::find($id);
        if ($daily) {
            $daily->status_product = $request->status_product; // Update status_product
            $daily->save();

            return response()->json(['success' => true, 'message' => 'Status berhasil diubah.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Daily stock tidak ditemukan.']);
        }
    }
}
<?php
// filepath: /d:/STO-master/STO-master/app/Http/Controllers/STOController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import the User model
use App\Models\Inventory; // Import the Inventory model
use App\Models\ReportSTO;
use Illuminate\Support\Facades\Validator;

class STOController extends Controller
{
  public function index()
  {
    $user = Auth::user();
    return view('STO.index', compact('user'));
  }

  public function scan(Request $request)
  {
    $request->validate([
      'inventory_id' => 'required|string',
    ]);

    $inventory = Inventory::where('inventory_id', $request->inventory_id)->first();

    if ($inventory) {
      return redirect()->route('sto.form',  $inventory->inventory_id);
    }

    return back()->with('error', 'Inventory not found. Please try again.');
  }

  public function form($inventory_id)
  {
    $inventory = Inventory::where('inventory_id', $inventory_id)->first();
    if ($inventory) {
      $last_report = ReportSTO::where('inventory_id', $inventory_id)->orderBy('created_at', 'desc')->first();
      return view('sto.form', compact('inventory', 'last_report'));
    }
    return back()->with('error', 'Inventory not found. Please try again.');
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'inventory_id' => 'required|exists:inventory,inventory_id',
      'issued_date' => 'required|date',
      'prepared_by' => 'required|exists:users,id',
      'checked_by' => 'nullable',
      'status' => 'required|string',
      'qty_per_box' => 'required|integer',
      'qty_box' => 'required|integer',
      'total' => 'required|integer',
      'grand_total' => 'required|integer',
    ]);

    $validatedData['user_id'] = auth()->id();

    // Create and save the report
    $reportSTO = ReportSTO::create($validatedData);

    // Redirect back with success message
    return redirect()->route('sto.index')->with('success', "Report STO with Inventory ID {$reportSTO->inventory_id} created successfully.");
  }

  public function showForm(Request $request)
  {
    $user = auth()->user();
    $inventory = null;

    if ($request->has('part_number')) {
      $inventory = Inventory::where('part_number', $request->input('part_number'))->first();
    }

    return view('STO.from', compact('user', 'inventory'));
  }

  public function manage(Request $request, $id)
  {
    // Your manage logic here
  }
}

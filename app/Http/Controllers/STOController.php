<?php
// filepath: /d:/STO-master/STO-master/app/Http/Controllers/STOController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import the User model
use App\Models\Inventory; // Import the Inventory model

class STOController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('STO.index', compact('user'));
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
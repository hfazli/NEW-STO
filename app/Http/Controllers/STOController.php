<?php
// filepath: /d:/STO-master/STO-master/app/Http/Controllers/STOController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import the User model
use App\Models\Inventory; // Import the Inventory model

class STOController extends Controller
{
    // Method untuk halaman index
    public function index()
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect ke halaman login jika belum login
        }

        // Ambil data yang diperlukan untuk halaman index
        $user = Auth::user();
        $inventory = Inventory::all(); // Contoh pengambilan data inventory

        return view('sto.index', compact('user', 'inventory'));
    }

    // Method untuk halaman form
    public function form(Request $request)
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect ke halaman login jika belum login
        }

        // Ambil data yang diperlukan untuk halaman form
        $user = Auth::user();
        $inventory = inventory::all(); // Contoh pengambilan data inventory

        return view('sto.form', compact('user', 'inventory'));
    }

    public function manage(Request $request, $id)
    {
        // Your manage logic here
    }

    public function report(Request $request)
    {
        // Handle the form submission and generate the report
        // ...

        return redirect()->back()->with('success', 'Report generated successfully.');
    }

    public function yourMethod()
    {
        $user = auth()->user(); // Atau cara lain untuk mendapatkan data pengguna

        return view('STO.from', compact('user'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{

    public function toggle(Request $request)
    {

        // Toggle tema di session
        $darkMode = session('dark_mode', false);
        session(['dark_mode' => !$darkMode]);

        // Kembalikan dengan status sukses
        return back()->with('success', 'Tema berhasil diperbarui');

    }

}

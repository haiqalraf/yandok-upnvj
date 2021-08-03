<?php

namespace App\Http\Controllers\superadmin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DekanController extends Controller
{
    public function index()
    {
        $dekan = User::where('is_admin', 3)->get();
        return view('superadmin.dekan', ['dekan' => $dekan]);
    }

    public function create()
    {
        return view('superadmin.create', ['role' => 3]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'password' => 'required|confirmed|string',
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'password' => bcrypt($request->password),
            'is_admin' => $request->role,
        ]);

        return redirect()->route('superadmin.dekan');
    }
}

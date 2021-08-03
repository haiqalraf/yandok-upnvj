<?php

namespace App\Http\Controllers\superadmin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AkpkController extends Controller
{
    public function index()
    {
        $akpk = User::where('is_admin', 2)->get();
        return view('superadmin.akpk', ['akpk' => $akpk]);
    }

    public function create()
    {
        return view('superadmin.create', ['role' => 2]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'password' => 'required|confirmed|string|min:8',
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'password' => bcrypt($request->password),
            'is_admin' => $request->role,
        ]);

        return redirect()->route('superadmin.akpk');
    }
}

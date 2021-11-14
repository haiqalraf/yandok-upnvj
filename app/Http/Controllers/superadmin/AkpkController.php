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
            'password' => 'required|confirmed|string',
            'role' => 'required',
        ]);

        $check = User::where('nim', $request->nim)->get();

        if (count($check) == 0){

            User::create([
                'name' => $request->name,
                'nim' => $request->nim,
                'password' => bcrypt($request->password),
                'is_admin' => $request->role,
            ]);

            // ALFIO
            return response()->json([
        
                'status' => true,
                'text' => 'Akun Berhasil dibuat.',
    
            ], 200);

        } else {

            // ALFIO
            return response()->json([
        
                'status' => false,
                'text' => 'Akun dengan NIP tersebut telah terdaftar  sebelumnya.',
    
            ], 200);
        }
            
        return redirect()->route('superadmin.akpk');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'nim' => 'required',
        ]);
        
        User::where('nim', $request->nim)->delete();
        return response()->json([
    
            'status' => true,
            'text' => 'Akun berhasil dihapus.',

        ], 200);
    }
}

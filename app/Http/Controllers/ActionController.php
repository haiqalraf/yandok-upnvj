<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Image;

class ActionController extends Controller
{
    //
    public function updateUser(Request $request){
        
        $request->validate([
            'nim' => 'required|string',
            'handphone' => 'required|string',
            'telepon' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'pekerjaan' => 'required|string',
            'nama_perusahaan' => 'required|string',
            'jabatan' => 'required|string',
            'alamat_perusahaan' => 'required|string',
        ]);
            
        try {

            $data = [
                'no_hp' => $request->handphone,
                'no_rumah' => $request->telepon,
                'address' => $request->alamat,
                'email' => $request->email,
                'pekerjaan' => $request->pekerjaan,
                'nama_perusahaan' => $request->nama_perusahaan,
                'jabatan' => $request->jabatan,
                'alamat_perusahaan' => $request->alamat_perusahaan,
            ];

            if (!empty($request->password)){
                $data['password'] = bcrypt($request->password);
            };
            
            if ($request->hasFile('foto')) {

                $image      = $request->file('foto');
                $fileName   = $request->nim.'.' . $image->getClientOriginalExtension();
                
                // if (file_exists(public_path().'/img/user/'.$fileName)) {
                //     unlink(public_path().'/img/user/'.$fileName);
                // }
    
                $img = Image::make($image->getRealPath());
                $img->resize(120, 120, function ($constraint) {
                    $constraint->aspectRatio();                 
                });
    
                $img->save(public_path('/img/user/' .$fileName)); // <-- Key point

                $data['photo'] = $fileName;
            }

            $User = new User;
            $User = $User->where('nim', $request->nim);
            $User->update($data);
            auth()->user()->pekerjaan = $request->jabatan;

            return response()->json([
        
                'status' => true,
                'text' => 'Update User Successfuly.',
    
            ], 200);
            
        } catch (Exception $err) {

            return response()->json([
        
                'status' => false,
                'text' => 'Error: '.$err,
    
            ], 200);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ActionController extends Controller
{
    //
    public function updateUser(Request $request){

        if ( $request->nim == null || $request->nim == '' ){

            return response()->json([
        
                'status' => false,
                'text' => 'NIM lo ga ada.',
    
            ], 400);

        } else {
            
            try {

                $data = [
                    'email' => $request->email,
                    'no_hp' => $request->handphone,
                    'no_rumah' => $request->telepon,
                    'pekerjaan' => $request->pekerjaan,
                    'address' => $request->alamat,
                ];
                
                $password = $request->password != '' ?  $data['password'] = bcrypt($request->password) : ''; 

                $User = new User;
                $User = $User->where('nim', $request->nim);
                $User->update($data);

                return response()->json([
            
                    'status' => false,
                    'text' => 'ok.',
        
                ], 200);
                
            } catch (Exception $err) {

                return response()->json([
            
                    'status' => false,
                    'text' => 'Error: '.$err,
        
                ], 200);
            }

        }
    }
}

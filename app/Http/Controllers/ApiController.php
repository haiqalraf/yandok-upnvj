<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function apiUpn(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'tgl' => 'required|date_format:Y-m-d'
        ]);

        $check = User::where('nim', $request->nim)->get();


        if (count($check) == 0){

            $client = new Client();
            $url = "https://api.upnvj.ac.id/mahasiswa/getAlumni";
    
            $headers = [
                'Authorization' => env('UPN_API_KEY', '')
            ];
    
            $mybody = [
                'nim' => $request->input('nim'),
                #'nim' =>'1720622083',
                'tanggal_lahir'=> $request->input('tgl')
                #'tanggal_lahir'=>'1988-07-23'
            ];
    
            // $request = $client->post($url,['headers'=>$headers, 'form_params'=>$mybody]);
            $response = $client->request('POST', $url, [
                'headers' => $headers,
                'form_params' => $mybody
            ]);
            $responseBody = json_decode($response->getBody()->getContents());
            if ($responseBody->message == null) {

                return response()->json([
            
                    'status' => true,
                    'data' => $responseBody->result,
                    'type' => 0,
        
                ], 200);

            } else {

                // ALFIO
                return response()->json([
            
                    'status' => false,
                    'text' => $responseBody->message,
        
                ], 200);
            }
        } else {

            // ALFIO
            return response()->json([
        
                'status' => false,
                'text' => 'Akun dengan NIM tersebut telah terdaftar  sebelumnya.',
    
            ], 200);
        }
    }

    public function storeData(Request $request){
        if ($request){
            $User = new User;
            $User->insert([
                'nim' => $request->nim_verified,
                'fakultas' => $User->encodeFakultas($request->fakultas),
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'tanggal_lahir' => $request->tanggal_lahir,
                'thn_lulus' => substr($request->tahun_lulus, strpos($request->tahun_lulus, "/") + 1),
                'no_hp' => $request->no_hp,
                'no_rumah' => $request->no_rumah,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // ALFIO
            return response()->json([
        
                'status' => true,
                'text' => 'Registration User Successfuly.',
                'type' => 1
    
            ], 200);

        } else {


            // ALFIO
            return response()->json([
        
                'status' => false,
                'text' => 'Error',
    
            ], 200);
        }
    }

    public function verifikasi(Request $request)
    {
        $client = new Client();
        $url = "https://api.upnvj.ac.id/mahasiswa/getAlumni";

        $headers = [
            'Authorization' => env('UPN_API_KEY', '')
        ];

        $mybody = [
            'nim' => $request->input('nim'),
            #'nim' =>'1720622083',
            'tanggal_lahir'=> $request->input('tgl')
            #'tanggal_lahir'=>'1988-07-23'
        ];

        $request = $client->post($url,['headers'=>$headers, 'form_params'=>$mybody]);
        $responseBody = json_decode($request->getBody()->getContents());

        return view('auth.register3', compact('responseBody'));
    }


}
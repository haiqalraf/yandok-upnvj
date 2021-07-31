<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;

class ApiController extends Controller
{
    public function apiUpn(Request $request)
    {
        $client = new Client();
        $url = "https://api.upnvj.ac.id/mahasiswa/getAlumni";

        $headers = [
            'Authorization' => 'Basic c2lha2FkOlMxNGs0ZA=='
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

        return view('auth.register2', compact('responseBody'));
    }

    public function storeData(Request $request){
        if ($request){

            $User = new User;
            $User->insert([
                'nim' => $request->nim_verified,
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'thn_lulus' => substr($request->tahun_lulus, strpos($request->tahun_lulus, "/") + 1),
                'no_hp' => $request->no_hp,
                'no_rumah' => $request->no_rumah,
            ]);

        } else {


        }

        return redirect()->route('login');
    }

    public function verifikasi(Request $request)
    {
        $client = new Client();
        $url = "https://api.upnvj.ac.id/mahasiswa/getAlumni";

        $headers = [
            'Authorization' => 'Basic c2lha2FkOlMxNGs0ZA=='
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
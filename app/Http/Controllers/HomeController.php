<?php
   
namespace App\Http\Controllers;
use App\Models\Legalisir;
use App\Models\TracerStudy;
use Illuminate\Http\Request;
   
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with(array('user'=>auth()->user()));
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function adminHome()
    // {
    //     print_r(auth()->user());
    //     return view('superadmin.home');
    // }

    // public function akpkHome()
    // {
    //     print_r(auth()->user());
    //     return view('akpk.home');
    // }
    
    // public function dekanHome()
    // {
    //     print_r(auth()->user());
    //     return view('dekan.home');
    // }

    public function alur()
    {
        return view('alur');
    }

    public function tracestudy()
    {
        if (auth()->user()->tracerstudy) {
            return abort(404);
        }
        return view('tracestudy');
    }

    public function updateTracer(Request $request)
    {
        if ($request->filled('tempat_kerja') || 
            $request->filled('jabatan') || 
            $request->filled('status_kerja') || 
            $request->filled('alamat_kerja') || 
            $request->filled('tanggal_kerja')) {
            
            $request->validate([
                'tempat_kerja' => 'required',
                'jabatan' => 'required',
                'status_kerja' => 'required',
                'alamat_kerja' => 'required',
                'tanggal_kerja' => 'required|date',

            ]);
            $tracer = new TracerStudy([
                'nim' => auth()->user()->nim,
                'tempat_kerja' => $request->tempat_kerja,
                'jabatan' => $request->jabatan,
                'alamat_kerja' => $request->alamat_kerja,
                'tanggal_kerja' => $request->tanggal_kerja,
                'status_kerja' => $request->status_kerja,
                'waktu_kontrak' => $request->waktu_kontrak,
            ]);
            auth()->user()->tracerstudy()->save($tracer);
            auth()->user()->save();
        } else {
            $tracer = new TracerStudy([
                'nim' => auth()->user()->nim,
            ]);
            auth()->user()->tracerstudy()->save($tracer);
        }

        return redirect()->route('home')->with('status', 'Tracer Study berhasil diisi!');
    }
}
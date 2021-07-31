<?php
   
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Legalisir;
use App\Models\TracerStudy;

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
    public function adminHome()
    {
        return view('admin.home');
    }
    
    public function alur()
    {
        return view('alur');
    }

    public function tracestudy()
    {
        return view('tracestudy');
    }

    public function updateTracer(Request $request)
    {
        if ($request->filled(['tempat_kerja', 'jabatan', 'status_kerja', 'waktu_kontrak'])) {
            $tracer = new TracerStudy([
                'nim' => auth()->user()->nim,
                'tempat_kerja' => $request->tempat_kerja,
                'jabatan' => $request->jabatan,
                'status_kerja' => $request->status_kerja,
                'waktu_kontrak' => $request->waktu_kontrak,
            ]);
            auth()->user()->tracerstudy()->save($tracer);
        } else {
            $tracer = new TracerStudy([
                'nim' => auth()->user()->nim,
            ]);
            auth()->user()->tracerstudy()->save($tracer);
        }

        return redirect()->route('home');
    }
}
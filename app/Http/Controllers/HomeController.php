<?php
   
namespace App\Http\Controllers;
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
        auth()->user()->is_tracer = true;
        auth()->user()->save();
        return redirect()->back();
    }
}
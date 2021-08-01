<?php
   
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Legalisir;
   
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

    public function akpkHome()
    {
        return view('akpk.home');
    }
    
    public function dekanHome()
    {
        return view('dekan.home');
    }

    public function superAdminHome()
    {
        return view('superadmin.home');
    }

    public function alur()
    {
        return view('alur');
    }
}
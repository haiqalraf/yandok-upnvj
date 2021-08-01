<?php
  
namespace App\Http\Controllers\Auth;
   
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
   
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
  
    use AuthenticatesUsers;
  
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
   
    public function login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'nim' => 'required',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('nim' => $input['nim'], 'password' => $input['password'])))
        {
            /*
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.home');
            }else{
                return redirect()->route('home');
            }
            */
            switch (auth()->user()->is_admin) {
                case 1:
                  return redirect()->route('admin.home');
                  break;
                case 2:
                  return redirect()->route('akpk.home');
                  break;
                case 3:
                  return redirect()->route('dekan.home');
                  break;
                case 4:
                  return redirect()->route('superadmin.home');
                default:
                  return redirect()->route('home');
            } 

        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }

        ############
        switch (auth()->user()->is_admin) {
            case 1:
              return redirect()->route('admin.home');
              break;
            case 2:
              return redirect()->route('admin.home');
              break;
            case 3:
              return redirect()->route('admin.home');
              break;
            default:
              return redirect()->route('home');
        }
          
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    
    public function AdminLogin(Request $request)
    {
        // echo "ami aisi";
        // die();
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        

        if(User::where('email',$request->email)->exists()){
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect('admin/home');
            }else{
    
                return redirect("/admin/login")->with('password_error','Wrong Password!');
            }
            
        }else{
            return redirect("/admin/login")->with('email_error','Incorrect Email Address');
        }
    }
    public function StdentLogin(Request $request)
    {
        // echo "ami aisi";
        // die();
        $request->validate([
            'student_roll' => 'required',
            'password' => 'required',
        ]);
   
        
        if(User::where('student_roll',$request->student_roll)->exists()){
            $credentials = $request->only('student_roll', 'password');
            if (Auth::attempt($credentials)) {
                return redirect('admin/home');
            }else{
    
                return redirect("/student/login")->with('password_error','Wrong Password!');
            }
            
        }else{
            return redirect("/student/login")->with('id_error','Incorrect Student ID!');
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

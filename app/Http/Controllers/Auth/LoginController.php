<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    protected $redirectTo = 'home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, array(
            'email' => 'required|email',
            'password' => 'required|min:6'
        ));
        echo $request->email;
        echo $request->password;

       if (Auth::guard('web')->attempt(
            ['email' => $request->email, 'password' => $request->password],  $request->remember
        )) { //echo 'Đăng nhập thành công';
            // nếu đăng nhập thành công thì chuyển hướng về view dashboard của admin
            return redirect('/home');

        } else{
        echo 'Đăng nhập fail';}
        // nếu đăng nhập thất bại thì quay trở về form đăng nhập
        // với giá trị của 2 ô input cũ là email và remember
        //return redirect()->back()->withInput($request->only('email', 'remember'));

    }
    public function logout() {
        echo 'đã đăng suất';
       /* Auth::guard('web')->logout();
        return redirect()->route('home');*/
        Auth::guard('admin')->logout();

        // chuyển hướng về trang login của admin
        return redirect()->route('admin.auth.login');
    }

}

<?php

namespace Modules\Portal\Http\Controllers\Auth;

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
    protected $redirectTo = 'portal';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:company')->except('logout');
    }


    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return auth()->guard(request()->guard);
    }


    public function showLoginForm()
    {
        return view('portal::auth.login');
    }

    protected function loggedOut(Request $request) {
        return redirect('portal');
    }


    protected function authenticated(Request $request, $user)
    {
        if($request->guard == 'admin'){
            return redirect()->route('admin.companies');
        } elseif($request->guard == 'company') {
            return redirect()->route('portal.dashboard');
        }
    }


}

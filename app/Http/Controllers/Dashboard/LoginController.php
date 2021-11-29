<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function redirectLogin()
    {
        return redirect()->route('admin.login.page');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function checkLogin(LoginRequest $request)
    {
        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            $notification = array(
                'message' => 'You are logged in successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.dashboard')->with($notification);
        }

        $notification = array(
            'message' => 'There is an error in the data, please check',
            'alert-type' => 'error'
        );

        return redirect() -> back()->with($notification);
    }

    public function logout()
    {
        $guard = $this->getGuard();
        $guard->logout();

        $notification = array(
            'message' => 'Signed out successfully',
            'alert-type' => 'success'
        );
        return redirect() ->route('admin.login.page')->with($notification);
    }

    private function getGuard()
    {
        return auth('admin');
    }
}

<?php

namespace App\Http\Controllers\front\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index()
    {
        return view('front.auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
        $all = $request->except('_token');
        if(Auth::attempt(['username'=>$all['username'],'password'=>$all['password'],'code'=>'']))
        {
            return redirect('/');
        }
        else
        {
            return redirect()->back()->with('warning','İstifadəçi Adı və ya Şifrə yanlışdır! Və ya E-Mail təsdiqi edilməyib!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}

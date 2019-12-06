<?php

namespace App\Http\Controllers\front\auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class registerController extends Controller
{
    public function index()
    {
        return view('front.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3',
            'username'=>'required|min:3',
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $all = $request->except('_token');
        $c = User::where('username',$all['username'])
            ->where('email',$all['email'])
            ->count();
        if($c==0)
        {
            $all['password'] = md5($all['password']);
            $all['code'] = substr(md5(uniqid()),0,6);
            $create = User::create($all);
            if($create)
            {
                try {
                    Mail::send('verifyEmail',$all,function ($message) use ($all){
                        $message->to($all['email'],$all['name'])->from(APP_EMAIL,APP_NAME);
                    });
                }
                catch (\Exception $e)
                {
                    dd($e->getMessage());
                }
                return redirect('tesdiqle');
            }
            else
            {
                return redirect()->back()->with('warning','Xəta baş verdi!');
            }
        }
        else
        {
            return redirect()->back()->with('info','İstifadəçi bazada mövcuddur');
        }

    }
}

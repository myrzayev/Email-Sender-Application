<?php

namespace App\Http\Controllers\front\auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class verifyController extends Controller
{
    public function index()
    {
        return view('front.auth.verify');
    }

    public function store(Request $request)
    {
        $all = $request->except('_token');
        $c = User::where('code',$all['code'])->count();
        if($c!=0)
        {
            $data = User::where('code',$all['code'])->get();
            foreach($data as $k => $v)
            {
                User::where('id',$v['id'])->update(['code'=>'']);
            }
            return redirect('/');
        }
        else
        {
            return redirect()->back()->with('warning','Təsdiqləmə kodu yanlışdır!');
        }
    }
}

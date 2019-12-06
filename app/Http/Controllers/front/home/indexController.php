<?php

namespace App\Http\Controllers\front\home;

use App\EmailSender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class indexController extends Controller
{
    public function index()
    {
        return view('front.home.index');
    }

    public function store(Request $request)
    {
        $all = $request->except('_token');
        $create = EmailSender::create([
            'email'=>json_encode($all['email']),
            'week_day'=>$all['week_day'],
            'time'=>$all['time'],
            'subject'=>$all['subject'],
            'text'=>$all['text']
        ]);
        if($create)
        {
            Artisan::call('Reminder:Start');
            return redirect()->back()->with('success','Mesajınız göndərildi');
        }
        else
        {
            return redirect()->back()->with('warning','Xəta baş verdi!  Mesajınız göndərilmədi');
        }
    }
}

<?php

namespace App\Http\Controllers\front\senders;

use App\EmailSender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index()
    {
        $senders = EmailSender::all();
        return view('front.senders.index',['senders'=>$senders]);
    }

    public function edit($id)
    {
        $c = EmailSender::where('id',$id)->count();
        if($c!=0)
        {
            $data = EmailSender::where('id',$id)->get();
            return view('front.senders.edit',['data'=>$data]);
        }
        else
        {
            return abort(404);
        }

    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = EmailSender::where('id',$id)->count();
        if($c!=0)
        {
            $all = $request->except('_token');
            $update = EmailSender::where('id',$id)->update([
                'email'=>json_encode($all['email']),
                'week_day'=>$all['week_day'],
                'time'=>$all['time'],
                'subject'=>$all['subject'],
                'text'=>$all['text']
            ]);
            if($update)
            {
                return redirect()->back()->with('success','Redaktə edildi');
            }
            else
            {
                return redirect()->back()->with('warning','Xəta baş verdi');
            }
        }
        else
        {
            return abort(404);
        }
    }

    public function delete($id)
    {
        $c = EmailSender::where('id',$id)->count();
        if($c!=0)
        {
            EmailSender::where('id',$id)->delete();
            return redirect()->back()->with('success','Silindi');
        }
        else
        {
            return abort(404);
        }
    }
}

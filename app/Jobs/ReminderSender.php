<?php

namespace App\Jobs;

use App\EmailSender;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class ReminderSender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $weekDay = date('l',time());
        $time = date('H:i');
        $list = EmailSender::where('week_day',$weekDay)
            ->where('isSend',REMINDER_DEFAULT)
            ->where('time',$time)
            ->get();
        foreach($list as $k => $v)
        {
            $data = [
                'email'=>json_decode($list[0]['email'],true),
                'week_day'=>$v['week_day'],
                'time'=>$v['time'],
                'subject'=>$v['subject'],
                'text'=>$v['text'],
            ];
            try {
                Mail::send('reminderEmail',$data,function ($message) use ($data){
                    $message->to($data['email'])
                        ->subject($data['subject'])
                        ->from(APP_EMAIL,APP_NAME);
                });
                EmailSender::where('id',$v['id'])->update(['isSend'=>REMINDER_SUCCESS]);
            }
            catch (\Exception $e)
            {
                dd($e->getMessage());
            }
        }
    }
}

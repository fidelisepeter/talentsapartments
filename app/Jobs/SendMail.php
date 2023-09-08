<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use function App\View\Components\send_mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mail_data;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mail_data)
    {
        $this->mail_data = $mail_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach(DB::table('users')->where('role', 'student')->get() as $user){

            send_mail($user->first_name, $user->email, $this->mail_data['subject'], $this->mail_data['message']);
            DB::table('user_notifications')->insert([
                'user_id' =>  $user->id,
                'title' => 'New Admin Message check your email for details',
                'message' => 'New Admin Message check your email for details',
                'status' => 'unread',
                'year' => DB::table('settings')->value('current_year')
            ]);
        }
    }
}

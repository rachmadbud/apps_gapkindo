<?php

namespace App\Jobs;

use App\Mail\Gmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class SendEmailJob implements ShouldQueue
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
    // public function handle()
    // {

    //     $details = [
    //         'title' => 'Thank you for subscribing to my newsletter',
    //         'body' => 'You will receive a newsletter every Fourth Friday of the month'

    //     ];
    //     Mail::to('fiqqirahman@gmail.com')->send(new Gmail($details));
    // }

    public function handle()
    {
        // Mail::to("kusdhian@gmail.com")->send(new MalasngodingEmail());

        $today = date("Y-m-d");
        $tgl = date("Y-m-d", strtotime($today . " + 3 days"));

        $users = DB::table('users')
            ->select('email')
            // ->where('id', 1)
            ->get();

        foreach ($users as $user) {
            // if($tgl == $user->tanggal_jatuh_tempo_laporan){
            Mail::to($user->email)->send(new Gmail());
            // }
        }

        return "Email telah dikirim";
    }
}
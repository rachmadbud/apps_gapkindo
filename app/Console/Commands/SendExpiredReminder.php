<?php

namespace App\Console\Commands;

use App\Mail\ExpiredReminderMail;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendExpiredReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:expired-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('COMMAND JALAN');
        $this->info('Jalan jam: ' . now());
        $targetStart = now()->addMonths(3)->startOfDay();
        $targetEnd = now()->addMonths(3)->endOfDay();

        $this->info('Range: ' . $targetStart . ' s/d ' . $targetEnd);

        $companies = \App\Models\Company::whereNull('reminder_sent_at')
            ->whereBetween('expired_at', [$targetStart, $targetEnd])
            ->get();

        $this->info('Jumlah data: ' . $companies->count());

        foreach ($companies as $company) {

            $this->info('Kirim ke: ' . $company->email);

            try {
                Mail::to($company->email)
                    ->send(new ExpiredReminderMail($company));

                $company->update([
                    'reminder_sent_at' => now(),
                    'reminder_status' => 'success'
                ]);
            } catch (\Exception $e) {

                $company->update([
                    'reminder_status' => 'failed'
                ]);

                Log::error($e->getMessage());
            }
        }
    }
}

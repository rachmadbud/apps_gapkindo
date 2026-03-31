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
        Log::info('CRON PRODUCTION JALAN: ' . now());
        $this->info('=== COMMAND JALAN ===');
        $this->info('Waktu: ' . now());

        $targetStart = now()->addMonths(3)->startOfDay();
        $targetEnd = now()->addMonths(3)->endOfDay();

        $this->info("Range: $targetStart s/d $targetEnd");

        $companies = \App\Models\Company::whereNull('reminder_sent_at')
            ->whereBetween('expired_at', [$targetStart, $targetEnd])
            ->get();

        $this->info('Jumlah data: ' . $companies->count());

        if ($companies->count() == 0) {
            $this->warn('Tidak ada data yang perlu dikirim');
            return;
        }

        foreach ($companies as $company) {

            $this->info('Proses ID: ' . $company->id);
            $this->info('Email: ' . $company->email);

            try {
                // 🔥 Ambil data yang aman saja (hindari MAC error)
                $data = [
                    'name' => $company->name,
                    'email' => $company->email,
                    'expired_at' => $company->expired_at,
                ];

                $this->info('STEP: sebelum kirim email');

                Mail::to($company->email)
                    ->send(new ExpiredReminderMail($data));

                $this->info('STEP: setelah kirim email');

                $company->update([
                    'reminder_sent_at' => now(),
                    'reminder_status' => 'success'
                ]);
            } catch (\Exception $e) {

                $this->error('ERROR: ' . $e->getMessage());

                Log::error('ERROR REMINDER COMPANY ID ' . $company->id);
                Log::error($e); // full stack trace

                $company->update([
                    'reminder_status' => 'failed'
                ]);
            }
        }

        $this->info('=== SELESAI ===');
    }
}

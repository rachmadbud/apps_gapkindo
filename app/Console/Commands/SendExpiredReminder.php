<?php

namespace App\Console\Commands;

use App\Mail\ExpiredReminderMail;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
        $this->info('Masuk handle');
        Log::info('CRON JALAN: ' . now());
        $this->info('=== COMMAND JALAN ===');
        $this->info('Waktu: ' . now());

        $targetStart = now()->addMonths(3)->startOfDay();
        $targetEnd = now()->addMonths(3)->endOfDay();

        $this->info("Range: $targetStart s/d $targetEnd");

        /*
    |--------------------------------------------------------------------------
    | 1. TPP (masatpp)
    |--------------------------------------------------------------------------
    */
        $tpps = DB::table('masatpp')
            ->whereNull('reminder_sent_at')
            ->whereBetween('tgl_berakhir', [$targetStart, $targetEnd])
            ->get();

        $this->info('Jumlah TPP: ' . $tpps->count());

        foreach ($tpps as $tpp) {
            $this->info('Proses TPP ID: ' . $tpp->id);

            try {

                $email = 'rachmadrachmadbud@gmail.com';
                $data = [
                    'name' => $tpp->name,
                    'jenis' => 'TPP',
                    'nomor' => $tpp->no_tpp,
                    'expired_at' => $tpp->tgl_berakhir,
                    'sender' => 'GAPKINDO PUSAT',
                    'subject' => 'Reminder Expired TPP'
                ];

                Mail::to($email)->send(new ExpiredReminderMail($data));

                DB::table('masatpp')
                    ->where('id', $tpp->id)
                    ->update([
                        'reminder_sent_at' => now(),
                        'reminder_status' => 'success'
                    ]);
            } catch (\Exception $e) {

                Log::error('ERROR TPP ID ' . $tpp->id);
                Log::error($e);

                DB::table('masatpp')
                    ->where('id', $tpp->id)
                    ->update([
                        'reminder_status' => 'failed'
                    ]);
            }
        }

        /*
    |--------------------------------------------------------------------------
    | 2. SPPT-SNI (masaspptsni)
    |--------------------------------------------------------------------------
    */
        $sppts = DB::table('masaspptsni')
            ->whereNull('reminder_sent_at')
            ->whereBetween('tgl_akhir', [$targetStart, $targetEnd])
            ->get();

        $this->info('Jumlah SPPT-SNI: ' . $sppts->count());

        foreach ($sppts as $sppt) {
            $this->info('Proses SPPT ID: ' . $sppt->id);

            try {

                $data = [
                    'name' => $sppt->name,
                    'jenis' => 'SPPT-SNI',
                    'nomor' => $sppt->no_spptsni,
                    'expired_at' => $sppt->tgl_akhir,
                    'sender' => 'GAPKINDO PUSAT',
                    'subject' => 'Reminder Expired SPPT-SNI'
                ];

                $email = 'rachmadrachmadbud@gmail.com';

                Mail::to($email)->send(new ExpiredReminderMail($data));

                DB::table('masaspptsni')
                    ->where('id', $sppt->id)
                    ->update([
                        'reminder_sent_at' => now(),
                        'reminder_status' => 'success'
                    ]);
            } catch (\Exception $e) {

                Log::error('ERROR SPPT ID ' . $sppt->id);
                Log::error($e);

                DB::table('masaspptsni')
                    ->where('id', $sppt->id)
                    ->update([
                        'reminder_status' => 'failed'
                    ]);
            }
        }

        $this->info('=== SELESAI ===');
    }
}

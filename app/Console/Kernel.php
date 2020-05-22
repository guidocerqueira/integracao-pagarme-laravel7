<?php

namespace App\Console;

use App\Transaction;
use Illuminate\Support\Facades\DB;
use App\Services\PagarmeRequestService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function(){
            $transactions = Transaction::where('payment_method', 'boleto')->where('status', '!=', 'paid')->get();

            $pagarme = new PagarmeRequestService();

            foreach ($transactions as $transaction) {
                $t = $pagarme->getTransaction($transaction->transaction_code);

                if (!isset($t['errors'])) {
                    $transaction->status = $t['status'];
                    $transaction->save();
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

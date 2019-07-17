<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Transaction;

class updateTransactionsTB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $transactions = Transaction::where('type', '=', 2)->get();
        foreach ($transactions as $key => $value) {
            $transaction = Transaction::find($value->id);
            $transaction->credit = $transaction->credit * 97 / 100;
            $transaction->save();
        }
    }
}

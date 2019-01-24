<?php

namespace App\Console\Commands;

use App\User;
use App\Jobs\UpdateAllCoinJob;
use App\Model\CryptoCurrencies;
use Illuminate\Console\Command;
use App\Notifications\AdminNotification;

class UpdateCrypto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updatecrypto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggiornamento delle Crypto Valute';

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
        //
        $this->line("Update Crypto in corso...");
        /*
        $cryptoCurrenciesToUpdate = CryptoCurrencies::all();
        $bar = $this->output->createProgressBar(count($cryptoCurrenciesToUpdate));

        foreach($cryptoCurrenciesToUpdate as $crypto){
            //to do
            $bar->advance();
        }

        $bar->finish();
        */
        UpdateAllCoinJob::dispatch(true);
        $this->line("");
        $this->line("Update Crypto terminato");
    }
}

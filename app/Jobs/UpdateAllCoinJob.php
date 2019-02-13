<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Model\AuditBalances;
use Illuminate\Bus\Queueable;
use App\Model\CryptoCurrencies;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateAllCoinJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notifyUser = false;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(){

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
        logger("Start Job:" . Carbon::now()->format('H:m:s'));
        UpdateAllCoinJob::updateCryptoAPI($this->notifyUser);
    }

    public static function updateCryptoAPI($notifyUser){

        //aggiorno solo quelle più vecchie di 24h;
        $cryptos = CryptoCurrencies::orderBy('my_gain','desc')->where('updated_at', '<', Carbon::now()->subDay())->get();
        $total = 0;

        //d($cryptos);

        //CHIAVE TUA LA TROVI REGISTRANTODI qui https://pro.coinmarketcap.com/account
        //nel riquadro api-key trovi la tua chiave
        //https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?CMC_PRO_API_KEY=CHIAVE_TUA&symbol=BTC&convert=EUR

        foreach($cryptos as $crypto){
            $crypto['my_gain'] = $crypto['price'] * $crypto['my_token'];
            $crypto['percent_change_7d'] =  0;
            $crypto['percent_change_24h'] = 0;

            if(!$crypto['my_price']){
                $endPoint = env('API_COINMARKET_MARKETS') . '?CMC_PRO_API_KEY='.env('API_COINMARKET_KEY')."&convert=EUR&symbol=".$crypto['symbol'];
                $cryptoCoin = json_decode(file_get_contents($endPoint), true);

                //crypto trovata
                if($cryptoCoin['data'] && $cryptoCoin['status']['error_message'] == null){
                    $symbol = $crypto['symbol'];
                    UpdateAllCoinJob::saveCryptoCurrency($crypto,$cryptoCoin['data'][$symbol]);
                //crypto non trovata
                }else{
                    //crypto non trovata
                }
            }

            $crypto->save();
            $total += $crypto['my_gain'];
        }

        //BALANCE UPDATE
        $auditBalance = AuditBalances::latest()->first();
        if($auditBalance == null){
            UpdateAllCoinJob::saveBalance($total);
        }else{
            if($auditBalance->created_at->toDateString() != Carbon::now()->toDateString()){
                UpdateAllCoinJob::saveBalance($total);
            }
        }

        logger("update crypto finish:" . Carbon::now()->format('H:m:s'));

        if($notifyUser){
            //$user = User::first();
            //$user->notify(new AdminNotification($total));
        }
    }

    public static function saveCryptoCurrency($crypto,$fgc){
        try{
            //dd($fgc);
            logger($fgc);

            $crypto['symbol']  = $fgc['symbol'];
            $crypto['name']    = $fgc['name'];

            foreach($fgc['quote'] as $key=>$quota){
                //logger($quota);
                //logger($key);
                if($key == 'EUR'){
                    $crypto['my_gain'] = round($quota['price'] * $crypto['my_token'],2);
                    $crypto['price']   = round($quota['price'],4);
                    $crypto['percent_change_7d'] =  ($quota["percent_change_7d"]  != null) ? $quota["percent_change_7d"] : 0;
                    $crypto['percent_change_24h'] = ($quota["percent_change_24h"] != null) ? $quota["percent_change_24h"] : 0;
                    break;
                }
            }
        }catch(\Exception $ex){

        }
    }


    /**
     * @param $total
     */
    public static function saveBalance($total){
        $auditBal = new AuditBalances();
        $auditBal->balance = $total;
        $auditBal->save();
    }
}

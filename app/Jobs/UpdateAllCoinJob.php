<?php

namespace App\Jobs;

use App\User;
use Carbon\Carbon;
use App\Model\AuditBalances;
use Illuminate\Bus\Queueable;
use PHPUnit\Runner\Exception;
use App\Model\CryptoCurrencies;
use Illuminate\Queue\SerializesModels;
use App\Notifications\AdminNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateAllCoinJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notifyUser = false;
    
    public function __construct($notifyUser){
       $this->notifyUser = $notifyUser;
    }

    public function handle(){
        logger("Start Job:" . Carbon::now()->format('H:m:s'));
        UpdateAllCoinJob::updateCryptoAPI($this->notifyUser);
    }

    public static function updateCryptoAPI($notifyUser){
        logger("updateCryptoAPI");
        //aggiorno solo quelle più vecchie di 24h;
        $cryptos = CryptoCurrencies::orderBy('my_gain','desc')->get();//->where('updated_at', '<', Carbon::now()->subDay())->get();
        $total = 0;

        //CHIAVE TUA LA TROVI REGISTRANTODI qui https://pro.coinmarketcap.com/account
        //nel riquadro api-key trovi la tua chiave
        //https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?CMC_PRO_API_KEY=CHIAVE_TUA&symbol=BTC&convert=EUR

        foreach($cryptos as $crypto){
            logger("Update Crypto:" . $crypto['symbol']);
            $crypto['my_gain'] = $crypto['price'] * $crypto['my_token'];
            $crypto['percent_change_7d'] =  0;
            $crypto['percent_change_24h'] = 0;

            if(!$crypto['my_price']){
                try {

                    $endPoint = env('API_COINMARKET_MARKETS') . '?CMC_PRO_API_KEY='.env('API_COINMARKET_KEY')."&convert=EUR&symbol=".$crypto['symbol'];
                    $cryptoCoin = json_decode(file_get_contents($endPoint), true);
    
                    //crypto trovata
                    if($cryptoCoin['data'] && $cryptoCoin['status']['error_message'] == null){
                        $symbol = $crypto['symbol'];
                        //logger($cryptoCoin['data'][$symbol]);
                        UpdateAllCoinJob::saveCryptoCurrency($crypto,$cryptoCoin['data'][$symbol]);
                    //crypto non trovata
                    }else{
                        //crypto non trovata
                        logger("crypto non trovata:" . $crypto['symbol']);
                    }

                }catch(\Exception $ex){
                    logger($ex);
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

        

        if($notifyUser){
            $user = User::first();
            logger("Notify :" . $user->email . " - Total : " . $total );
            $user->notify(new AdminNotification($total));
        }

        logger("update crypto finish:" . Carbon::now()->format('H:m:s'));

    }

    public static function saveCryptoCurrency($crypto,$fgc){
        logger("saveCryptoCurrency");
        try{
            //dd($fgc);
            //logger($fgc);

            $crypto['symbol']  = $fgc['symbol'];
            $crypto['name']    = $fgc['name'];

            foreach($fgc['quote'] as $key=>$quota){
                if($key == 'EUR'){
                    logger($quota);
                    logger($key);
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

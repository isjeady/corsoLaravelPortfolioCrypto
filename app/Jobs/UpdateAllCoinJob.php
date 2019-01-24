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

        $cryptos = CryptoCurrencies::orderBy('my_gain','desc')->get();
        $total = 0;
        
        $cnmkt = env('API_COINMARKET_MARKETS') . "?limit=3000&convert=EUR";
        $fgcs = json_decode(file_get_contents($cnmkt), true);

        foreach($cryptos as $crypto){
            $crypto['my_gain'] = $crypto['price'] * $crypto['my_token'];
            $crypto['percent_change_7d'] =  0;
            $crypto['percent_change_24h'] = 0;

            if(!$crypto['my_price']){
                if($crypto['name_id'] == 'bankera'){
                    $cnmkt = env('API_COINMARKET_MARKETS') . "/2842/?convert=EUR";
                    $fgcsC = json_decode(file_get_contents($cnmkt), true);
                    UpdateAllCoinJob::saveCryptoCurrency($crypto,$fgcsC['data']);
                }else{
                    foreach($fgcs['data'] as $fgc){
                        if($fgc['website_slug'] == $crypto['name_id']) {
                            UpdateAllCoinJob::saveCryptoCurrency($crypto,$fgc);
                            break;
                        }
                    }
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
        logger($fgc['id'] . " -- " . $crypto['name_id'] ." -- ".$fgc['website_slug']);

        $crypto['symbol']  = $fgc['symbol'];
        $crypto['name']    = $fgc['name'];

        foreach($fgc['quotes'] as $key=>$quota){
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

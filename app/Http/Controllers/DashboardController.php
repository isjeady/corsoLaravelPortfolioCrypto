<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CryptoCurrencies;
use App\Model\AuditBalances;

class DashboardController extends Controller
{
    //

    public function index(Request $request){

        $cryptoCurrenciesValues = CryptoCurrencies::all();
        $totalElements = $cryptoCurrenciesValues->count();
        
        $startTotalBalance = round($cryptoCurrenciesValues->sum('total'),2);
        $currentTotalBalance = round($cryptoCurrenciesValues->sum('my_gain'),2);
        $totalGain = $currentTotalBalance - $startTotalBalance;

        $auditBalances = AuditBalances::orderBy('created_at','desc')->limit(25)->get();
        $balances = AuditBalances::orderBy('created_at','asc')->get()->map(function ($u) {
            return $u->balance;
        });

        $gains = AuditBalances::orderBy('created_at','asc')->get()->map(function ($u) {
            return $u->balance;
        });
        foreach ($gains as $id=>$value) {
            $gains[$id] -= $startTotalBalance;
        }


        $balancesDate = AuditBalances::orderBy('created_at','asc')->get()->map(function ($u) {
            return $u->created_at->format("d-m-Y");
        });

        $chartjsBalance = app()->chartjs
            ->name('chartjsBalance')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($balancesDate->toArray())
            ->datasets([
                [
                    "label" => "Balances",
                    'backgroundColor' => "rgba(38, 185, 154, 0.3)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 1)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 1)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $balances,
                ]
            ])
            ->options([]);


        $chartjsGain = app()->chartjs
            ->name('chartjsGain')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($balancesDate->toArray())
            ->datasets([
                [
                    "label" => "Gain",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $gains,
                ]
            ])
            ->options([]);

        return view('pages.dashboard', compact('totalElements','chartjsGain','chartjsBalance','startTotalBalance','currentTotalBalance','totalGain'));

    }

}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\AuditBalances;
use Illuminate\Http\Request;
use App\Jobs\UpdateAllCoinJob;
use App\Model\CryptoCurrencies;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class CryptoCurrenciesController extends Controller
{

    public function view(Request $request){

        UpdateAllCoinJob::dispatch(false);

        $cryptoCurrenciesValues = CryptoCurrencies::orderBy('my_gain','desc')->paginate(10);
        $date = Carbon::now()->format("d-m-Y");

        return view('pages.cryptocurrencies.list', compact('cryptoCurrenciesValues','date'));

    }

    public function new(Request $request){
        $recordToEdit = new CryptoCurrencies();
        $newOrEdit = true;
        return view('pages.cryptocurrencies.new_or_edit',compact('recordToEdit','newOrEdit'));
    }

    public function edit(Request $request){
        if(is_numeric($request->id)){
            //load Record To Edit
            $recordToEdit = CryptoCurrencies::where('id', $request->id)->get()->first();

            if($recordToEdit){
                //dd($recordToEdit);
                $newOrEdit = false;
                return view('pages.cryptocurrencies.new_or_edit',compact('recordToEdit','newOrEdit'));
            }else{
                return \Redirect::route('cryptocurrenciesRoute');
            }

        }else{
            return \Redirect::route('cryptocurrenciesRoute');
        }
    }


    public function save(Request $request){
        //Validation
        $rules = [
            'name' => 'required|max:25',
            'name_id' => 'required|max:25',
            'symbol' => 'nullable|max:5',
            'my_token' => 'required|numeric',
            'site_store' => 'nullable',
            'my_price' => 'nullable',
            'price' => 'nullable|numeric',
        ];

        $message = [
            'name.max' => 'Name max 25',
        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if($validator->fails()){
            return redirect('cryptocurrencies/new')
                ->withErrors($validator)
                ->withInput();
        }

        if($request->get('id')){
            //edit
            $recordToEdit = CryptoCurrencies::where('id', $request->get('id'))->get()->first();
            if($recordToEdit){
                $myCrypto = $recordToEdit;



            }else{
                return \Redirect::route('cryptocurrenciesRoute');
            }
        }else{
            //Save
            $myCrypto = new CryptoCurrencies();
            //Total e Gain
            $myCrypto->total = $myCrypto->my_token * $myCrypto->price;
            $myCrypto->my_gain = $myCrypto->current_total - $myCrypto->total;
            $myCrypto->price = $request->get('price') == null ? 0 : $request->get('price');
        }

        $myCrypto->name = $request->get('name');
        $myCrypto->name_id = $request->get('name_id');
        $myCrypto->my_token = $request->get('my_token');

        $myCrypto->symbol = $request->get('symbol') == null ? "" : strtoupper($request->get('symbol'));
        $myCrypto->site_store = $request->get('site_store') == null ? "" : $request->get('site_store');
        $myCrypto->my_price = $request->get('my_price') == null ? false : $request->get('my_price');

        if($myCrypto->my_price){
            $myCrypto->current_total = $myCrypto->total;
            $myCrypto->current_price = $myCrypto->price;
        }

        if($myCrypto->my_price){
            $myCrypto->current_total = $myCrypto->total;
            $myCrypto->current_price = $myCrypto->price;
        }

        //Total e Gain
        $myCrypto->total = $myCrypto->my_token * $myCrypto->price;
        $myCrypto->my_gain = $myCrypto->current_total - $myCrypto->total;

        $myCrypto->save();

        //logger($myCrypto);
        if($request->get('id')){
            return \Redirect::route('cryptocurrenciesRoute.new')->with('message', 'Valore Aggiornato correttamente !');
        }else{
            return \Redirect::route('cryptocurrenciesRoute.new')->with('message', 'Valore Inserito correttamente !');
        }

    }

    public function delete(Request $request , $id){
        if($request->ajax()){
            $recordToDelete = CryptoCurrencies::where('id', $id)->get()->first();
            $recordToDelete->delete();
            return response()->json('success', 200);
        }else{
            return \Redirect::route('cryptocurrenciesRoute');
        }
    }

    public function get(Request $request , $id){
        if(is_numeric($id)){
            //load Record To Edit
            $recordToView = CryptoCurrencies::where('id', $id)->get()->first();

            if($recordToView){
                return view('pages.cryptocurrencies.view',compact('recordToView'));
            }else{
                return \Redirect::route('cryptocurrenciesRoute');
            }

        }else{
            return \Redirect::route('cryptocurrenciesRoute');
        }
    }
}

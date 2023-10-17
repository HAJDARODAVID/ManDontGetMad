<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GameboardController extends Controller
{
    public function index(Request $request){

        //$request->session()->pull('gameRoom');

        //dd($request->session()->all());
       
        if(!(Auth::user())){
            return redirect('/');
        }
        return view('gameboard.gameboard',[
            'myGameRoom' => $request->session()->get('gameRoom'),
            'displayModal' => $this->getModelDisplay($request)
        ]);
    }

    private function getModelDisplay($request){
        if ($request->session()->get('gameRoom')==0 && Auth::user()->type == 0){
            return "block";
        }else{
            return "none";
        }
    }
}

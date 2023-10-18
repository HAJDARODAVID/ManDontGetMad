<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GameRoom;
use Illuminate\Http\Request;
use App\Models\GameRoomMember;
use App\Models\UserOnlineStatus;
use DateTime;
use Illuminate\Support\Facades\Auth;


class GameboardController extends Controller
{
    public function index(Request $request){

        //GameRoom::create(['status'=>1]);

        // GameRoomMember::create([
        //     'game_id' => 1,
        //     'user_id' => 1,
        // ]);
        // $player = GameRoomMember::with(['player'])->get();
        // dd($player);

        //dd(GameRoomMember::with(['getPlayerInfo'])->get());

        //dd(date("Y-m-d h:m:s"));
        
       
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

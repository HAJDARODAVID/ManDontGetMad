<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\GameRoom;
use Illuminate\Http\Request;
use App\Models\GameRoomMember;
use App\Models\UserOnlineStatus;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GameController;
use App\Models\FiguresPositionModel;

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

        //echo PlayerController::getUserOnlineStatus(2);
        //AdminController::cancelRoom(51);

        //GameController::startGame(1);

        //dd(GameRoomMember::with('getFigureInfo')->get());

        //dd(FiguresPositionModel::with('getFigureInfo')->get());
       
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

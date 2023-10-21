<?php

namespace App\Http\Controllers;

use App\Models\FigureModel;
use App\Models\GameRoom;
use App\Models\GameRoomMember;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class GameController extends Controller
{
    private static $colorPallet=[
        1=> 'ff0000',
        2=> '51ff00',
        3=> '2529ff',
        4=> 'ff29f4',
        5=> '12da97',
        6=> 'fae62f',
    ];

    static public function startGame($game){
        GameRoom::where('id', $game)->update(['status' => 1]);
        $roomMembersObj = GameRoomMember::where('game_id', $game)->with('getPlayerInfo')->get();
        foreach ($roomMembersObj as $member) {
            do {
                $myColor = FigureModel::where('id', rand(1,6))->first();
            } while (GameRoomMember::where('game_id', $game)->where('color', $myColor->color)->first() != null);
            $member->update(['color' => $myColor->color]);
        } 
    
    }

}

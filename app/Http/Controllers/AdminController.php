<?php

namespace App\Http\Controllers;

use App\Models\GameRoom;
use Illuminate\Http\Request;
use App\Models\GameRoomMember;

class AdminController extends Controller
{
    public function index(){
        return view('admin.admin');
    }

    static public function getAllGameRooms(){
        return GameRoom::orderBy('id', 'DESC')->paginate(15);
    }
       
    static public function cancelRoom($room){
        $roomObj = GameRoom::where('id', $room)->first();
        $roomMembersObj= GameRoomMember::where('game_id',$roomObj->id)->get();
        foreach ($roomMembersObj as $member) {
            PlayerController::removeUserFromGame($member->getPlayerInfo);
        }
        $roomObj->update([
            'status' => -1,
        ]);
    }
}

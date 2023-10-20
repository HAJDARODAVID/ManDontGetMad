<?php

namespace App\Http\Controllers;

use App\Models\GameRoomMember;
use App\Models\User;
use App\Models\UserOnlineStatus;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class PlayerController extends Controller
{
    static public function getUserOnlineStatus($user){
        //7200s => 120min
        $player = UserOnlineStatus::where('user_id', $user)->first();
        if(!($player===NULL) && time()-strtotime($player->updated_at)<7200){
            return true;
        }else{
            return false;
        }
    }

    static public function removeUserFromGame(User $user){
        GameRoomMember::where('user_id', $user->id)->delete();
    }
}

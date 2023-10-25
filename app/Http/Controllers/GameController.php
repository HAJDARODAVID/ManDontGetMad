<?php

namespace App\Http\Controllers;

use App\Models\FieldsModel;
use App\Models\FigureModel;
use App\Models\FiguresPositionModel;
use App\Models\GameRoom;
use App\Models\GameRoomMember;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class GameController extends Controller
{

    static public function startGame($game){
        GameRoom::where('id', $game)->update(['status' => 1]);
        $roomMembersObj = GameRoomMember::where('game_id', $game)->with('getPlayerInfo')->get(); 
        foreach ($roomMembersObj as $member) {
            do {
                $figure = FigureModel::where('id', rand(1,6))->first();
            } while (GameRoomMember::where('game_id', $game)->where('figure_id', $figure->id)->first() != null);
            $member->update(['figure_id' => $figure->id]);
            $fields = FieldsModel::where('alias','like',$figure->alias.'_home%')->get();
            foreach ($fields as $field) {
                FiguresPositionModel::create([
                    'game_id' => $game,
                    'figure_id' => $member->figure_id,
                    'figure_sub_id' => substr($field->alias,-1),
                    'field_id' => $field->id,
                ]);
            }
            
        } 
    }

}

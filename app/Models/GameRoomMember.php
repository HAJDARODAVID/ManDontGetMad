<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GameRoomMember extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'game_id',
        'figure_id',
    ];

    public function getPlayerInfo(): HasOne
    {
        return $this->hasONe(User::class, 'id','user_id');
    }

    public function getGameInfo(): HasOne
    {
        return $this->hasONe(GameRoom::class, 'id','game_id');
    }
    public function getFigureInfo(): HasMany
    {
        return $this->hasMany(FigureModel::class, 'id','figure_id');
    }
}

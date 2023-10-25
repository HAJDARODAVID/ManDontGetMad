<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FiguresPositionModel extends Model
{
    use HasFactory;

    protected $table= 'figures_positions';

    public $timestamps = false;

    protected $fillable = [
        'game_id',
        'figure_id',
        'figure_sub_id',
        'field_id',
    ];

    public function getFigureInfo(): HasOne
    {
        return $this->hasOne(FigureModel::class, 'id','figure_id');
    }
    public function getFieldInfo(): HasOne
    {
        return $this->hasOne(FieldsModel::class, 'id','field_id');
    }
}

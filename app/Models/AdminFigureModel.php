<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminFigureModel extends Model
{
    use HasFactory;

    protected $table = 'admin_figure';

    public $timestamps = false;

    protected $fillable = [
        'top',
        'left',
    ];
}

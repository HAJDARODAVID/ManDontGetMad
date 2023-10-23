<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldsModel extends Model
{
    use HasFactory;

    protected $table = 'fields';

    public $timestamps = false;

    protected $fillable = [
        'alias',
        'top',
        'left',
        'nextField',
    ];
}

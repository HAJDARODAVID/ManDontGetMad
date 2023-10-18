<?php

namespace App\Http\Controllers;

use App\Models\GameRoom;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.admin');
    }

    static public function getAllGameRooms(){
        return GameRoom::orderBy('id', 'DESC')->paginate(15);
    }
}

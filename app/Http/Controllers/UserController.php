<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function user(Request $request){
         $data = User::all();
         return response()->json([$data],200);
    }
}

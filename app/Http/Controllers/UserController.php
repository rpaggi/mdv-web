<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::all();

        if($request->filled('json')){
            return response()->json($users, 200);
        }
    }
}

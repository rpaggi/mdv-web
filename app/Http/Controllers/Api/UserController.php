<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::role("agent")->get();

        if($request->filled('json')){
            return response()->json($users, 200);
        }
    }
}

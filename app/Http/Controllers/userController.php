<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    //
    public function index() {

        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('dashboard', compact('users'));
    }

    public function userChat($userId) {
        return view('user-chat', compact('userId'));
    }
}

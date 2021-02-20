<?php

namespace App\Http\Controllers\web;

use DB;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        $users = User::IsNotAdmin()->paginate(10);

        // dd($users); menampilkan data 
        return view('admin.users.index', compact('users'));
    }
}

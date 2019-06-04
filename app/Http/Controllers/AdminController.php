<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function appointAs($id){
        User::find($id)->hasRole('doctor')
            ? User::find($id)->roles()->detach(Role::where('name', 'doctor')->first())
            : User::find($id)->roles()->attach(Role::where('name', 'doctor')->first());
        return view('admin', ['users' => User::paginate(5)]);
    }
}

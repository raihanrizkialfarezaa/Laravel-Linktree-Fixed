<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $id = Auth::id();
        $users = User::where('roles', 'USER');
        $ketua = User::where('roles', 'KETUA');
        $links = Link::all();
        $linkuser = Link::where('user_id', $id)->get();
        return view('page.admin.admin', compact('users', 'links', 'linkuser', 'ketua'));
    }
}

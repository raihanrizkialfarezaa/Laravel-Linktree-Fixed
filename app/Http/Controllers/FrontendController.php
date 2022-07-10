<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Link;
use App\Models\Office;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        $id = Auth::id();
            $links = Link::where('user_id', $id)->get();
            return view('page.users.link', compact('links'));
    }
    public function officelinks() {
        $office = Office::all();
        return view('page.users.office', compact('office'));
    }
}

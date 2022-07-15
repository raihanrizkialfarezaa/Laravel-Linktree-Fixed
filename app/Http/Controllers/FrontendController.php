<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Link;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index() {
        $id = Auth::id();
        DB::enableQueryLog();
            $link = Link::where('user_id', $id)
                         ->where(function ($query) {
                            $query->where('link', 'LIKE', 'https://%')
                                  ->orWhere('link', 'LIKE', 'http://%');
                         })
                         ->get();
            $links = Link::where('user_id', $id)
                          ->whereNot(function ($query) {
                                        $query->where('link', 'LIKE', 'https://%')
                                            ->orWhere('link', 'LIKE', 'http://%');
                                    })
            ->get();
            $links = Link::where('user_id', $id)
                          ->whereNot(function ($query) {
                                        $query->where('link', 'LIKE', 'https://%')
                                            ->orWhere('link', 'LIKE', 'http://%');
                                    })
            ->get();
            // dd($id);
            // dd($link);
            return view('page.users.link', compact('links', 'link'));
    }
    public function officelinks() {
        $offices = Office::whereNot(function ($query) {
            $query->where('link', 'LIKE', 'https://%')
                ->orWhere('link', 'LIKE', 'http://%');
        })
        ->get();
        $office = Office::where(function ($query) {
            $query->where('link', 'LIKE', 'https://%')
                ->orWhere('link', 'LIKE', 'http://%');
        })
        ->get();
        return view('page.users.office', compact('office', 'offices'));
    }
}

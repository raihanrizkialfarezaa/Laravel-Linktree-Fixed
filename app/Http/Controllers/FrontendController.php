<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Link;
use App\Models\User;
use App\Models\Ketua;
use App\Models\Office;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index() {
        $id = Auth::id();
        DB::enableQueryLog();
            if (Auth::user()->roles == 'KETUA') {
                $link = Link::where('user_id', $id)
                             ->where(function ($query) {
                                $query->where('link', 'LIKE', 'https://%')
                                        ->orWhere('link', 'LIKE', 'http://%');
                                })
                             ->groupBy('category_id')
                             ->get()
                             ->toArray();
                // dd($link[0]->category);
                
                $links = Link::where('user_id', $id)
                             ->whereNot(function ($query) {
                                            $query->where('link', 'LIKE', 'https://%')
                                                ->orWhere('link', 'LIKE', 'http://%');
                                        })
                             ->groupBy('category_id')
                             ->get()
                             ->toArray();
                // foreach ($link as $l) {
                //     return dd($l);
                // }
                $ketuas = Ketua::whereNot(function ($query) {
                                            $query->where('link', 'LIKE', 'https://%')
                                                ->orWhere('link', 'LIKE', 'http://%');
                                        })
                                ->groupBy('category_id')
                                ->get();
                $ketua = Ketua::where(function ($query) {
                            $query->where('link', 'LIKE', 'https://%')
                                ->orWhere('link', 'LIKE', 'http://%');
                        })
                             ->groupBy('category_id')
                             ->get();
                $category = Category::all();
                // foreach ($category as $cat) {
                //     dd($category);
                // }
                // dd($ketuas);
                return view('page.users.link', compact('links', 'link', 'ketua', 'ketuas', 'category'));
            } else {
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
                $category = Category::all();
                return view('page.users.link', compact('links', 'link', 'category'));
            }
            
            // dd($id);
            // dd($link);
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
        $category = Category::all();
        return view('page.users.office', compact('office', 'offices', 'category'));
    }
    public function ketualink() {
        if (Auth::user()->roles == 'KETUA') {
            $category = Category::all();
            return view('page.users.ketua', compact('category'));
        } else {
            return redirect('/');
        }
        
    }

    public function edituser() {
        $id = Auth::id();
        $users = User::findOrFail($id);

        return view('page.users.edit', compact('users'));
    }
}

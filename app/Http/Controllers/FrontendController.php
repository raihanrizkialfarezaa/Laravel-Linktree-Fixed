<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Link;
use App\Models\User;
use App\Models\Ketua;
use App\Models\Office;
use App\Models\Category;
use App\Models\CategoryUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index() {
        $id = Auth::id();
        DB::enableQueryLog();
            if (Auth::user()->roles == 'KETUA') {
                // dd(DB::getQueryLog());
                $link = Link::where('user_id', $id)
                             ->where('category_user_id', null)
                             ->get();
                if ($link->count() > 0) {
                    $linkTotal = $link-count();
                } else {
                    $linkTotal = 0;
                }

                // dd($linkTotal);
                
                $category = CategoryUser::where('user_id', Auth::id())->get();
                // dd($link);
                // foreach ($category as $cat) {
                //     dd($category);
                // }
                // dd($ketuas);
                return view('page.users.link', compact( 'link', 'category', 'linkTotal'));
            } else {
                $link = Link::where('user_id', Auth::id())
                             ->where('category_user_id', null)
                             ->get();
                if ($link->count() > 0) {
                    $linkTotal = $link-count();
                } else {
                    $linkTotal = 0;
                }
                // dd($linkTotal);
                $category = CategoryUser::where('user_id', Auth::id())->get();
                // dd($categories);
                // foreach ($categories as $cat) {
                //     $category = $cat->links->where('user_id', $id);
                // }
                // dd($category[0]->links->where('user_id', 5));
                return view('page.users.link', compact('link', 'category', 'linkTotal'));
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

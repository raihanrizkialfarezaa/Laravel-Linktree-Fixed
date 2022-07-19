<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\Link;
use App\Models\User;
use App\Models\Category;
use App\Models\CategoryUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = Auth::id();
        DB::enableQueryLog();
        // $links = Link::findOrFail($id)->first();
        // dd($links->user->name);
        // $links = Link::where('user_id', $id)->get();
        if($request->filled('search')){
            $search = $request->search;
            $links = Link::where('user_id', $id)
                         ->where(function ($query) use ($search) {
                            $query->where('link', 'LIKE', '%' . $search . '%')
                                ->orWhere('name', 'LIKE', '%' . $search . '%');
                         })
                         ->get();
            // dd(DB::getQueryLog());
        }else{
            if ($request->filled('showAll')) {
                $links = Link::where('user_id', $id);
            } else {
                $links = Link::where('user_id', $id)->paginate(10);
            }
            
        }
        return view('page.admin.links.index', compact('links'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = User::where('roles', 'ADMIN')->orWhere('roles', 'KETUA')->get();
        $category = CategoryUser::where('user_id', Auth::id())->get();
        return view('page.admin.links.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $id = Auth::id();
        $data['user_id'] = $id;
        if (empty($request->link)) {
            Session::flash('gagal','Link tidak boleh kosong');
		    return redirect()->route('links.create');
        } else {
            $create = Link::create($data);
        }
        
        return redirect()->route('links.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $links = Link::findOrFail($id);
        $category = CategoryUser::where('user_id', Auth::id())->get();

        return view('page.admin.links.edit', compact('links', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $links = Link::findOrFail($id);
        
        $update = $links->update([
            'name' => $request->name,
            'link' => $request->link,
            'category_user_id' => $request->category_user_id
        ]);

        if ($update) {
            return redirect()->route('links.index');
        } else {
            dd($error);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $links = Link::findOrFail($id);

        $delete = $links->delete();

        return redirect()->route('links.index');
    }
}

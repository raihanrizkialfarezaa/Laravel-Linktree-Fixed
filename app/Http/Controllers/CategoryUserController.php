<?php

namespace App\Http\Controllers;

use App\Models\CategoryUser;
use Auth;
use Session;
use Illuminate\Http\Request;

class CategoryUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->filled('search')){
            $search = $request->search;
            $category = CategoryUser::where('user_id', Auth::id())
                         ->where(function ($query) use ($search) {
                            $query->where('name', 'LIKE', '%' . $search . '%');
                         })
                         ->get();
            // dd(DB::getQueryLog());
        }else{
            if ($request->filled('showAll')) {
                $category = CategoryUser::where('user_id', Auth::id())->get();
            } else {
                $category = CategoryUser::where('user_id', Auth::id())->paginate(10);
            }
            
        }
        return view('page.admin.categoryuser.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.admin.categoryuser.create');
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
        $data['user_id'] = Auth::id();
        $name = CategoryUser::where('user_id', Auth::id())
                             ->where('name', $request->name)
                             ->first();
        if ($name != null) {
            Session::flash('gagal','Nama category sudah ada');
		    return redirect()->route('categoryuser.create');
        } else {
            $create = CategoryUser::create($data);
        }
        return redirect()->route('categoryuser.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CategoryUser::findOrFail($id);

        return view('page.admin.categoryuser.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = CategoryUser::findOrFail($id);
        $name = CategoryUser::where('user_id', Auth::id())
                             ->where('name', $request->name)
                             ->first();

        if ($name != null) {
            Session::flash('gagal','Nama category sudah ada');
            return redirect()->route('categoryuser.edit');
        } else {
            $update = $category->update([
                'name' => $request->name
            ]);
        }

        return redirect()->route('categoryuser.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = CategoryUser::findOrFail($id);

        $delete = $category->delete();

        return redirect()->route('categoryuser.index');
    }
}

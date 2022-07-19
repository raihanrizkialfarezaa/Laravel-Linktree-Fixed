<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Session;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
            $category = Category::where(function ($query) use ($search) {
                            $query->where('name', 'LIKE', '%' . $search . '%');
                         })
                         ->get();
            // dd(DB::getQueryLog());
        }else{
            if ($request->filled('showAll')) {
                $category = Category::all();
            } else {
                $category = Category::paginate(10);
            }
            
        }
        return view('page.admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.admin.category.create');
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
        $name = Category::where('name', $request->name)->count();
        // dd($name);
        if (empty($request->name)) {
            Session::flash('gagal','Nama category tidak boleh kosong');
		    return redirect()->route('category.create');
        }
        elseif($name != 0) {
            Session::flash('gagal','Nama category sudah ada');
		    return redirect()->route('category.create');
        } else {
            $create = Category::create($data);
        }
        
        return redirect()->route('category.index');
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
        $category = Category::findOrFail($id);

        return view('page.admin.category.edit', compact('category'));
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
        $category = Category::findOrFail($id);
        $name = Category::where('name', $request->name)->first();

        if ($name != null) {
            Session::flash('gagal','Nama category sudah ada');
            return redirect()->route('category.edit');
        } else {
            $update = $category->update([
                'name' => $request->name
            ]);
        }
        

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $delete = $category->delete();

        return redirect()->route('category.index');
    }
}

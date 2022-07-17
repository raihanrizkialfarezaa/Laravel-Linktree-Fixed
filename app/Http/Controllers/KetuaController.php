<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Ketua;
use App\Models\Category;
use Illuminate\Http\Request;

class KetuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = Auth::id();
        // $links = Ketua::findOrFail($id)->first();
        // dd($links->user->name);
        if (Auth::user()->roles == 'ADMIN') {
            // $user_id = User::where('roles', 'ADMIN')
            //                 ->orWhere('roles', 'KETUA')
            //                 ->get('id')
            //                 ->toArray();
            // dd($user_id);
            if($request->filled('search')){
                $ketua = Ketua::where('link', 'LIKE', '%' . $request->search . '%')
                              ->get();
            }else{
                if ($request->filled('showAll')) {
                    $ketua = Ketua::all();
                } else {
                    $ketua = Ketua::paginate(10);
                }
                
            }
            return view('page.admin.ketua.index', compact('ketua'));
        } else {
            return redirect('/');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = User::where('roles', 'ADMIN')->orWhere('roles', 'KETUA')->get();
        $category = Category::all();
        return view('page.admin.ketua.create', compact('category'));
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

        $create = Ketua::create($data);
        return redirect()->route('ketua.index');
        
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
        $ketua = Ketua::findOrFail($id);
        $category = Category::all();

        return view('page.admin.ketua.edit', compact('ketua', 'category'));
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
        $ketua = Ketua::findOrFail($id);
        
        $update = $ketua->update([
            'name' => $request->name,
            'link' => $request->link
        ]);

        if ($update) {
            return redirect()->route('ketua.index');
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
        $ketua = Ketua::findOrFail($id);

        $delete = $ketua->delete();

        return redirect()->route('ketua.index');
    }
}

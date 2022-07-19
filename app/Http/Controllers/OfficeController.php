<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Category;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->filled('search')){
            $office = Office::where('link', 'LIKE', '%' . $request->search . '%')
                             ->orWhere('name', 'LIKE', '%' . $request->search . '%')
                             ->get();
        }else{
            if ($request->filled('showAll')) {
                $office = Office::all();
            } else {
                $office = Office::paginate(10);
            }
            
        }
        // dd($office[0]->category);
        return view('page.admin.office.index', compact('office'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('page.admin.office.create', compact('category'));
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
        Office::create($data);
        return redirect()->route('office.index');
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
        $office = Office::findOrFail($id);
        $category = Category::all();

        return view('page.admin.office.edit', compact('office', 'category'));
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
        $office = Office::findOrFail($id);
        
        $update = $office->update([
            'links' => $request->links,
            'name' => $request->name,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('office.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $office = Office::findOrFail($id);

        $delete = $office->delete();

        return redirect()->route('office.index');
    }
}

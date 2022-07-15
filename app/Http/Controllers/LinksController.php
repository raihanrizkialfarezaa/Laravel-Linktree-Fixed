<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        // $links = Link::findOrFail($id)->first();
        // dd($links->user->name);
        if (Auth::user()->roles == 'ADMIN') {
            $user_id = User::where('roles', 'ADMIN')
                            ->orWhere('roles', 'KETUA')
                            ->get('id')
                            ->toArray();
            // dd($user_id);
            $link = Link::whereIn('user_id', $user_id)
                          ->whereNotIn('link', ['https://', 'http://'])
                          ->get();
            $links = Link::whereIn('user_id', $user_id)
                         ->whereIn('link', ['https://', 'http://'])
                         ->get();
            return view('page.admin.links.index', compact('links', 'link'));
        } else {
            $links = Link::where('user_id', $id)->get();
            return view('page.admin.links.index', compact('links'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('roles', 'ADMIN')->orWhere('roles', 'KETUA')->get();
        return view('page.admin.links.create', compact('user'));
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
        if (Auth::user()->roles == 'ADMIN') {
            $create = Link::create($data);
        } else {
            $data['user_id'] = $id;
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

        return view('page.admin.links.edit', compact('links'));
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
            'link' => $request->link
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

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Session;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->roles == 'ADMIN') {
            $user = User::all();
            return view('page.admin.users.index', compact('user'));
        } else {
            return redirect('/linkuser');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.admin.users.create');
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
        $data['password'] = bcrypt($request->password);
        User::create($data);
        return redirect()->route('users.index');
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
        $users = User::findOrFail($id);
        $roles = [
            'ADMIN',
            'USER'
        ];

        return view('page.admin.users.edit', compact('users', 'roles'));
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
        $users = User::findOrFail($id);
        
        $emailExists = User::where('email', $request->email)->first();

        if ($emailExists != null) {
            Session::flash('gagal','Email yang anda masukkan telah terdaftar!');
		    return redirect()->route('edit-user');
        } else {
            if (empty($request->password)) {
                $update = $users->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'roles' => $request->roles
                ]);
            } else {
                $crypt = bcrypt($request->password);
                $update = $users->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $crypt,
                    'roles' => $request->roles,
                ]);
            }
        }
        return redirect()->route('users.index');
    }
    public function updateuser(Request $request, $id)
    {
        $users = User::findOrFail($id);
        
        $emailExists = User::where('email', $request->email)->first();

        if ($emailExists != null) {
            Session::flash('gagal','Email yang anda masukkan telah terdaftar!');
		    return redirect()->route('edit-user');
        } elseif($emailExists == null && empty($request->password)) {
            $update = $users->update([
                'name' => $request->name,
                'email' => $request->email,
                'roles' => $request->roles
            ]);
            return redirect()->route('link-user');
        } else {
            $crypt = bcrypt($request->password);
            $update = $users->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $crypt,
                'roles' => $request->roles
            ]);
            return redirect()->route('link-user');
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
        $users = User::findOrFail($id);

        $delete = $users->delete();
        return redirect()->route('users.index');
    }
}

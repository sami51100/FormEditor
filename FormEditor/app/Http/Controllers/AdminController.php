<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $usersList = User::orderBy('role_id', 'Asc')->get();
        return view('admin.list', ['usersList' => $usersList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $roles = Role::pluck('role_nom', 'id');
        return view('admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        // $request->validated();
        // $users = User::make($request->input());
        // $users->user()->associate(Auth::id());
        // $users->save();

        $users = User::create([
            'lastname' => $request['lastname'],
            'firstname' => $request['firstname'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            // 'profile_photo_path' => $request['profile_photo_path'],
            'role_id' => $request['role_id'],
        ]);

        return redirect()->route('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.consult', ['users' => User::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('user-access', User::findOrFail($id)->role_id)) {
            abort('403');
        }
        // $roles = Role::pluck('role_nom', 'id');
        // return view('admin.edit', ['users' => User::findOrFail($id), 'roles' => $roles]);
        return view('admin.edit', ['users' => User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAdminRequest $request, User $user, $id)
    {
        // dd('hello: ' . $user);
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        $request->validated();

        User::findOrFail($id)->update($request->input());
        //$user->update($request->input());
        return redirect()->route('admin', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $users = User::findOrFail($id);
        // $users->delete();

        $user = User::findOrFail($id);
        $user->forms->each->delete();
        $user->delete();

        return redirect()->route('admin');
    }
}

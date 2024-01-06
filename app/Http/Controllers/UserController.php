<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{

    public const MAX_STRING_LENGTH = 255;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$users = User::paginate(25);
        $users = User::orderBy('id')->paginate(25);
        return view('users.index', ["users" => $users]);
    }

    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:' . self::MAX_STRING_LENGTH],
            'email' => ['required', 'string', 'email', 'max:' . self::MAX_STRING_LENGTH, 'unique:users'],
            'city' => ['required', 'string', 'max:' . self::MAX_STRING_LENGTH],
            'password' => ['required', 'string', 'min:8'],
        ]);

        return redirect('/users')->with('success', 'User inserted successfully');
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }


    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect('/users');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users');
    }
}

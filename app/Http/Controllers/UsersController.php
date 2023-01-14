<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index()
    {
        return view('users.index')->with('users', User::all());
    }
    public function create()
    {
        return view('users.create');
    }

    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();
        return redirect(route('users.index'));

    }
    public function removeAdmin(User $user)
    {
        $user->role = 'writer';
        $user->save();
        return redirect(route('users.index'));
    }

    public function edit(User $user , Profile $profile)
    {
        $profile = $user->profile;
        return view('users.profile',['user' =>$user , 'profile' =>$profile]);
    }
    public function update(User $user , Request $request)
    {
        // dd($request->all());
        $profile = $user->profile;
        $data = $request->all();
        if ($request->hasFile('picture')) {
            $picture = $request->picture->store('profilePicture','public');
            $data['picture'] = $picture;
        }
        $profile->update($data);
        return redirect(route('home'));
    }
}

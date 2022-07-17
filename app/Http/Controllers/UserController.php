<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index')->with([
            'users' => User::all(),
            'title' => 'users'
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'role' => 'required',
            'name' => 'required|max:255',
            'email' =>  'required|email:dns|max:255|unique:users',
            'password' =>  'required|min:6|max:255|confirmed'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return back()->with('success', 'New user successfully created');
    }

    public function changePass(Request $request) {
        
        $validatedData = $request->validate([
            'user_id' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if($validatedData['user_id'] != 1) {
            User::where('id', $validatedData['user_id'])->update([
                'password' => bcrypt($validatedData['new_password'])
            ]);

            return back()->with('success', 'Password successfully changed');
        } else {
            return back()->with('fail', 'Super admin password cannot be changed!');
        }
        

    }

    public function changeRole(Request $request) {
        
        $validatedData = $request->validate([
            'user_id' => 'required',
            'new_role' => 'required',
        ]);

        if($validatedData['user_id'] != 1) {
            User::where('id', $validatedData['user_id'])->update([
                'role' => $validatedData['new_role']
            ]);

            return back()->with('success', 'Role successfully changed');
        } else {
            return back()->with('fail', 'Super admin role cannot be changed!');
        }

    }

    public function destroy(User $user){

        if($user->id != 1) {
            User::destroy($user->id);
        return back()->with('success', 'User successfully deleted');
        } else {
            return back()->with('fail', 'Super admin cannot be deleted!');
        }
    
    }
}

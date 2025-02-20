<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function showAll() {
        $user = DB::table('users')->get();
        if (Auth::id() !== 1) {
            return redirect('/dashboard')->with('error', 'Unauthorized access.');
        }

        $user = DB::table('users')->get();
        return view('pages.user', ['user' => $user]);
    }

    public function delete($id)
    {
    DB::table('users')->where('id', '=', $id)->delete();
    return redirect('/user');
    }

    public function edit($id)
    {
        $user = DB::table('users')->get();
        if (Auth::id() !== 1) {
            return redirect('/dashboard')->with('error', 'Unauthorized access.');
        }

        $user = DB::table('users')->find($id);
        return view('pages.edit-user', ['user' => $user]);
    }
    public function update(Request $request, $id)
    {
    $data = $request->validate([
        'id' => 'required|integer',
        'nama' => 'required|string|max:255',
        'full_name' => 'required|string|max:255',
        'password' => 'required',
    ]);


    $data['password'] = Hash::make($data['password']);

    DB::table('users')->where('id', $id)->update($data);

    return redirect('/users')->with('success', 'User updated successfully');
    }
}

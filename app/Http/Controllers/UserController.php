<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function admins()
    {
        return view('admins', ['admins' => User::all()->where('type', 'admin')]);
    }
    public function viewers()
    {
        return view('viewers', ['viewers' => User::all()->where('type', 'viewer')]);
    }
    public function editors()
    {
        return view('editors', ['editors' => User::all()->where('type', 'editor')]);
    }
    public function markasadmin($id)
    {
        $user = User::find($id);
        $user->type = "admin";
        $user->save();
        return redirect()->back();
    }
    public function markasviewer($id)
    {
        $user = User::find($id);
        $user->type = "viewer";
        $user->save();
        return redirect()->back();
    }
    public function markaseditor($id)
    {
        $user = User::find($id);
        $user->type = "editor";
        $user->save();
        return redirect()->back();
    }

    public function addnewuser(Request $req)
    {
        $user = new User();
        $user->name = $req->name;
        $user->password = Hash::make($req->password);
        $user->email = $req->email;
        $user->type = "viewer";
        $user->save();
        return redirect()->back()->with('success', 'User created successfully!');
    }
}

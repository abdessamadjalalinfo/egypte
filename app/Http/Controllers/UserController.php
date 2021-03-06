<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function myprofil()
    {
        return view('myprofil');
    }

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
    public function changePassword(Request $request)
    {
        
    

        
        $user = User::find(Auth::user()->id);
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->name=$request->name;

        
        //dd($request->password);
        $user->save();
        return redirect()->back();
    }
}

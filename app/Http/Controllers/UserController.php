<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Team;

class UserController extends Controller
{

  public function index()
  {

      $superadminuser = User::where('role','=','superadmin')->get();
      $adminuser = User::where('role','=','admin')->get();
      $normaluser = User::where('role','=','user')->get();
      $alluser = User::all();
      $team = Team::all();
      $user = auth()->user();


      if ($user->role=='admin'|$user->role=='superadmin') {
        return view('usermanagement',compact('superadminuser','adminuser','normaluser','alluser','team'));
    }
    return redirect('/');

  }

  public function store(Request $request)
  {


    $validated = $request->validate([
        'email' => 'required|unique:users|max:255',
    ]);


      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->team = $request->team;
      $user->role = $request->role;
      $user->password = Hash::make($request->password);
      $user->save();
      return redirect('usermanagement')->with('status', 'Registrierung erfolgreich.');
  }

  public function delete(Request $request)
  {
            User::destroy($request->id);
            return redirect('usermanagement')->with('status', 'Benutzer*in gelöscht');

    }

}

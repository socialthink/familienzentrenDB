<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class InitialisierungsController extends Controller
{
  public function index()
  {

      $user = new User;
      $user->name = 'Superadmin';
      $user->email = 'no-reply@socialthink.net';
      $user->team = 'initialsierung';
      $user->role = 'superadmin';
      $user->password = Hash::make('unbedingtanpassensonstgehtdasnichtgutaus');
      $user->save();
      return redirect('login')->with('status', 'Initialsierung erfolgreich.');
  }
}

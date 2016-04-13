<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Validator, Session, Redirect, Hash;

class UsersController extends Controller {
  public function create() {
    return view('users.create');
  }

  public function store(Request $request) {
    $data = $request->all();
    $validate = Validator::make($data, User::valid());
    if ($validate->fails()) {
      return Redirect::to('users/create')->withErrors($validate)->withInput();
    } else {
      $user = new User;
      $user->email = $request->email;
      $user->name = $request->name;
      $user->password = Hash::make($request->password);
      $user->save();
      Session::flash('notice', 'Signup Success');
      return Redirect::to('users/create');
    }
  }
}

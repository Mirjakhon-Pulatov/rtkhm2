<?php

namespace App\Http\Controllers;

use App\Models\Content_types;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(User $users)
    {
        $users = DB::select("SELECT * from users WHERE id <> '1' ");
        return view('admin.user', compact('users'));
    }

    public function add_user(Request $request, User $user)
    {
//        dd($request->all());
        $login = $request->input('login');
        $email = $request->input('email');
        $password = $request->input('password');
        $user = new User();
        $user->login = $login;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->role = 'user';
        $user->pwd_label = $password;
        $user->save();
        return redirect()->back();
    }

    public function delete_user(Request $request, User $user)
    {
//        dd($request->all());
        $id = $request->input('user_id');
        $user = User::where('id', "=", $id);
        $user->delete();

        return redirect()->back();
    }


    public function ChangeisMenu(Request $request, Content_types $ct)
    {
        $ct = Content_types::find($request->input('id'));
        $ct->is_menu = $request->input('InputValue');
        $ct->update();
        return response()->json(['success' => "Изменено !", 'inputValue' => $request->input('InputValue'), 'id' => $request->input('id')]);
    }
}

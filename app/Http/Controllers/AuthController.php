<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class AuthController extends Controller
{
    public function ajaxLogin(Request $request)
    {
        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {
            $ipAddress = $request->ip();
            $currentDateTime = Carbon::now();
            DB::statement("INSERT INTO `logs` ( `ip`, `time`) VALUES ( '$ipAddress', '$currentDateTime') ");


            return response()->json(['success' => true, 'redirect' => 'dashboard']);
        } else {
            return response()->json(['error' => 'Wrong data'], 422);
        }
    }

    public function profile(User $users)
    {
        return view('admin.profile.profile', compact('users'));
    }

    public function profile_update(Request $request, User $user)
    {
        $user = User::find($request->id);
        $request->validate([
            'login' => 'required',
            'email' => 'required|unique:users,email,' . $request->id,
            'old_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    return $fail('Old password xato');
                }
            }],
            'password' => 'required'
        ]);

        $user->login = $request->input('login');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->update();

        return redirect()->route('dashboard');
    }

    public function delete_logs()
    {
        DB::table('logs')->truncate();
        return redirect()->route('dashboard')->with('success', 'Очищено !');
    }

    public function delete_visitors()
    {
        DB::table('visitors')->truncate();
        return redirect()->route('dashboard')->with('success', 'Очищено !');
    }


    public function logout()
    {
        Auth::logout(); // Выход пользователя из системы
        return redirect()->route('login'); // Перенаправляем на главную страницу после выхода
    }


    // keyin kabinetga ishlataman
    public function CheckUSer(Request $request)
    {

        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['message' => 'Пользователь с такой почтой уже существует'], 422);
        }

        return response()->json(['message' => 'Пользователь с такой почтой не найден'], 200);
    }
}

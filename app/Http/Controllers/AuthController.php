<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function showLogin()
    {
        return Inertia::render('Auth/Login');
    }

    public function login(Request $request)
    {
        try {
            //code...
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ], [
                '*.required' => ':attribute wajib diisi',
                'email.email' => 'Email harus valid',
            ], [
                'email' => 'Email',
                'password' => 'Password'
            ]);

            if(!Auth::attempt($credentials))
            {
                throw ValidationException::withMessages([
                    'email' => 'Kredensial tidak valid'
                ]);
            }

            $request->session()->regenerate();

            return to_route('dashboard')->with('message', 'Selamat datang di halaman dashboard');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi suatu kesalahan, mohon untuk mencoba beberapa saat kembali.');
        }
    }

    public function showRegister()
    {
        return Inertia::render('Auth/Register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            $credentials = $request->validated();

            $credentials['password'] = Hash::make($credentials['password']);

            User::create($credentials);

            return to_route('auth.show.login')->with('message', 'Berhasil membuat akun baru');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi suatu kesalahan, mohon untuk mencoba beberapa saat kembali.');
        }
    }

    public function logout(Request $request)
    {
        try {

            auth()->logout();

            request()->session()->invalidate();
            request()->session()->regenerateToken();


            return to_route('auth.show.login')->with('message', 'Berhasil melakukan logout');
        } catch (\Exception $e) {
            return back()->with('danger', 'Ada kesalahan pada saat mencoba logout');
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function index()
    {
        // if user not login return view login don't access dashboard
        if (!auth()->user()) {
            return view('login');
        }

        // if user login redirect to dashboard
        return redirect()->route('dashboard');

        // return view('login');
    }

    public function login(Request $request)
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi'
        ]);

        //add role manual to auth
        $role = $request->type;
        $credentials['role'] = $role;

        if ($role == 0 || $role == 1) {
            //login with user model
            $user = User::where('email', $credentials['email'])->first();
            if (!$user) {
                return back()->withErrors([
                    'email' => 'Akun tidak ditemukan'
                ]);
            }
            $check_password = password_verify($credentials['password'], $user->password);
            if (!$check_password) {
                return back()->withErrors([
                    'email' => 'Password salah'
                ]);
            }

            auth()->login($user);
            return redirect()->route('dashboard');
        }
        else if ($role == 2) {
            //login with user model
            $user = User::where('email', $credentials['email'])->first();
            if (!$user) {
                return back()->withErrors([
                    'email' => 'Akun tidak ditemukan'
                ]);
            }
            $check_password = password_verify($credentials['password'], $user->password);
            if (!$check_password) {
                return back()->withErrors([
                    'email' => 'Password salah'
                ]);
            }

            auth()->login($user);
            return redirect()->route('pengunjung.create');
        }
        // if (\auth()->user()->role == 2) {
        //     // return '/dashboard';
        //     return view('user.dashboard');
        // }

    }

    public function register(Request $request)
    {
        $credentials = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi'
        ]);

        //add role manual to auth
        $role = $request->type;
        $credentials['role'] = $role;

        if ($role == 0) {
            //login with user model
            $user = User::where('email', $credentials['email'])->first();
            if ($user) {
                return back()->withErrors([
                    'email' => 'Email sudah terdaftar'
                ]);
            }
            $credentials['password'] = bcrypt($credentials['password']);
            $user = User::create($credentials);
            auth()->login($user);
            return redirect()->route('dashboard');
        }

        //if role == 1 (petugas)
        if ($role == 1) {
            //login with user model
            $user = User::where('email', $credentials['email'])->first();
            if ($user) {
                return back()->withErrors([
                    'email' => 'Email sudah terdaftar'
                ]);
            }
            $credentials['password'] = bcrypt($credentials['password']);
            $user = User::create($credentials);
            auth()->login($user);
            return redirect()->route('dashboard');
        }

        //if role == 2 (user)
        if ($role == 2) {
            //login with user model
            $user = User::where('email', $credentials['email'])->first();
            if ($user) {
                return back()->withErrors([
                    'email' => 'Email sudah terdaftar'
                ]);
            }
            $credentials['password'] = bcrypt($credentials['password']);
            $user = User::create($credentials);
            auth()->login($user);
            return redirect()->route('dashboard');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('login');
    }


}

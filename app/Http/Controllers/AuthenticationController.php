<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;


class AuthenticationController extends Controller
{
    public function login() {
        return view('account.login');
    }

    public function postLogin(Request $request) {
        $request->validate([
            'phone' => ['required'],
            'password' => ['required']
        ], [
            'phone.required' => 'SĐT không được để trống',
            'password' => 'Mật khẩu không được để trống'
        ]);
        

        if (Auth::attempt([
            'phone' => $request->phone,
            'password' => $request->password
        ])) {
            if(Auth::user()->role == 1) {
                return redirect()->route('admin.index');
            }else {
                return redirect()->route('index');
            }
            
        } else {
            return redirect()->back()->with([
                'messageError' => 'SĐT hoặc mật khẩu không đúng'
            ]);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('index');
    }
   

    public function register() {
        return view('account.register');
    }

    public function postRegister(RegisterRequest $request) {
        if ($request->password !== $request->nhapLaiPassword) {
            return back()->withErrors([
                'nhapLaiPassword' => 'Mật khẩu xác nhận không khớp.'
            ])->withInput();
        }

        // Mã hóa mật khẩu
        $mahoaPassword = Hash::make($request->password);

        // Tạo người dùng mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $mahoaPassword,
            'address' => $request->address,
        ]);
    
        return redirect()->route('login');
    }

}

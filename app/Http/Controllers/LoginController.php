<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

  public function index()
  {
    if (Auth::check()) {
      if (Auth::user()->role_name == 'admin') {
        return redirect('/admin/admin-profile');
      }
      return redirect('/');
    }
    return view('login');
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required|min:6|max:20'
    ], [
      'email.required' => 'Trường email không được bỏ trống',
      'email.email' => 'Trường email không đúng định dạng',
      'password.required' => 'Trường mật khẩu không được bỏ trống',
      'password.min' => 'Trường mật khẩu phải nhập tối thiểu :min ký tự',
      'password.max' => 'Trường mật khẩu không được vượt quá :max ký tự',
    ]);

    // $user = User::where('email', '=', $request->email)->first();
    // if ($user) {
    //     if (Hash::check($request->password, $user->password)) {
    //         $request->session()->put('loginId', $user->id);
    //         return redirect('/user-profile');
    //     } else {
    //         return back()->with('fail', 'Sai mật khẩu.');
    //     }
    // } else {
    //     return back()->with('fail', 'Email này chưa được đăng ký.');
    // }

    // Đăng nhập nhấn nút Ghi nhớ tài khoản (Remember Me) tạo cookie
    $email = request('email');
    $password = request('password');
    $remember = request('remember');
    if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
      if (auth()->user()->role_name == 'admin') {
        return redirect('/admin/admin-profile');
      } else {
        //return redirect('/user-profile');
        return redirect('/user-profile');
      }
    }
    ;

    // Đăng nhập không nhấn nút Ghi nhớ tài khoản (Remember Me)
    $user = User::where('email', '=', $request->email)->first();
    if ($user) {
      $credentials = $request->only('email', 'password');
      if (Auth::attempt($credentials)) {
        // return redirect('/user-profile');
        if (auth()->user()->role_name == 'admin') {
          return redirect('/admin/admin-profile');
        } else {
          //return redirect('/user-profile');
          return redirect('/user-profile');
        }
      } else {
        return back()->with("fail", "Nhập sai email hoặc mật khẩu.");
      }
    } else {
      return back()->with('fail', 'Email này chưa được đăng ký.');
    }
  }

  // Chuyển đến trang user
  public function layout_user()
  {
    if (Auth::check()) {
      if (Auth::user()->role_name == 'admin') {
        return redirect('/admin/admin-profile');
      }
    }
    $user = Auth::user();
    return view('user-profile', compact('user'));
  }

  // Chuyển đến trang admin
  public function layout_admin()
  {
    $user = Auth::user();
    return view('admin.admin-profile', compact('user'));
  }


  // Đăng xuất
  public function logout(Request $request)
  {
    Auth::logout();
    return redirect('/login');
  }
}
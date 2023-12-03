<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordManagerController extends Controller
{
  function forgetPassword()
  {
    return view('forget-password');
  }

  function forgetPasswordPost(Request $request)
  {
    $request->validate([
      'email' => 'required|email|exists:users',
    ], [
      'email.required' => 'Trường email không được bỏ trống',
      'email.email' => 'Trường email không đúng định dạng',
      'email.exists' => 'Email chưa được đăng ký',
    ]);

    // $token = Str::random(64);
    $token = strtoupper(Str::random(64));

    DB::table('password_resets')->insert([
      'email' => $request->email,
      'token' => $token,
      'created_at' => Carbon::now()
    ]);

    Mail::send('emails.forget-password', ['token' => $token], function ($message) use ($request) {
      $message->to($request->email);
      $message->subject("Thay đổi mật khẩu");
    });

    return redirect()->to(route("forget.password"))->with("success", "Chúng tôi đã gửi email để thay đổi mật khẩu.");
  }

  function resetPassword($token)
  {
    return view('new-password', compact('token'));
  }

  function resetPasswordPost(Request $request)
  {
    $request->validate([
      'email' => 'required|email|exists:users',
      'password' => 'required|min:6|max:20',
      'confirm_password' => 'required|min:6|max:20',
    ], [
      'email.required' => 'Trường email không được bỏ trống',
      'email.email' => 'Trường email không đúng định dạng',
      'email.exists' => 'Email chưa được đăng ký',
      'password.required' => 'Trường mật khẩu không được bỏ trống',
      'password.min' => 'Trường mật khẩu phải nhập tối thiểu :min ký tự',
      'password.max' => 'Trường mật khẩu không được vượt quá :max ký tự',
      'confirm_password.required' => 'Trường xác nhận mật khẩu không được bỏ trống',
      'confirm_password.min' => 'Trường xác nhận mật khẩu phải nhập tối thiểu :min ký tự',
      'confirm_password.max' => 'Trường xác nhận mật khẩu không được vượt quá :max ký tự',
    ]);

    $updatePassword = DB::table('password_resets')->where([
      "email" => $request->email,
      "token" => $request->token
    ])->first();

    if (!$updatePassword) {
      // return redirect()->to(route('reset.password'))->with("error", "Không hợp lệ");
      return redirect('/reset-password/{token}')->with("error", "Không hợp lệ");
    }

    User::where("email", $request->email)->update(["password" => Hash::make($request->password)]);

    DB::table('password_resets')->where(["email" => $request->email])->delete();

    // return redirect()->to(route('login'))->with("success", "Thay đổi mật khẩu thành công");
    return redirect('/login')->with("success", "Thay đổi mật khẩu thành công");
  }
}
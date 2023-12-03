<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
  public function index()
  {
    if (Auth::check()) {
      if (Auth::user()->role_name == 'admin') {
        return redirect('/admin/admin-profile');
      }
      return redirect('/');
    }
    return view('register');
  }

  public function register(Request $request)
  {
    $request->validate([
      'username' => 'required|max:20|unique:users',
      'password' => 'required|min:6|max:20',
      'confirm_password' => 'required|min:6|max:20',
      'email' => 'required|email|unique:users',
      'phone_number' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/', 'max:10'],
      'city' => 'required|max:20',
      // 'role_name' => 'required',
    ], [
      'username.required' => 'Trường tên người dùng không được bỏ trống',
      'username.max' => 'Trường tên người dùng không được vượt quá :max ký tự',
      'username.unique' => 'Tên người dùng đã được dùng. Vui lòng nhập tên khác.',
      'password.required' => 'Trường mật khẩu không được bỏ trống',
      'password.min' => 'Trường mật khẩu phải nhập tối thiểu :min ký tự',
      'password.max' => 'Trường mật khẩu không được vượt quá :max ký tự',
      'confirm_password.required' => 'Trường xác nhận mật khẩu không được bỏ trống',
      'confirm_password.min' => 'Trường xác nhận mật khẩu phải nhập tối thiểu :min ký tự',
      'confirm_password.max' => 'Trường xác nhận mật khẩu không được vượt quá :max ký tự',
      'email.required' => 'Trường email không được bỏ trống',
      'email.email' => 'Trường email không đúng định dạng',
      'email.unique' => 'Email đã được dùng. Vui lòng nhập email khác.',
      'phone_number.required' => 'Trường số điện thoại không được bỏ trống',
      'phone_number.regex' => 'Trường số điện thoại không đúng định dạng',
      'phone_number.max' => 'Trường số điện thoại không được vượt quá :max ký tự',
      'city.required' => 'Trường tỉnh thành phố không được bỏ trống',
      'city.max' => 'Trường tỉnh thành phố không được vượt quá :max ký tự',
      // 'role_name.required' => 'Trường quyền sử dụng không được bỏ trống',
    ]);


    // Xử lý file
    $isUploadAvatar = $request->hasFile('avatar');

    $imageName = 'no-avatar.jpg'; //file mặc định là hình no avatar
    if ($isUploadAvatar) {
      $file = $request->file('avatar');
      $file_name = $file->getClientOriginalName();
      $extension = $file->getClientOriginalExtension(); // lấy ra phần mở rộng của file tải lên
      if (strcasecmp($extension, 'jpg') === 0 || strcasecmp($extension, 'png') === 0) {
        $imageName = Str::random(5) . '_' . $file_name;
        // Kiểm tra nếu tên trùng thì lấy tên khác cho tới khi tên k còn trùng thì dừng
        while (file_exists($imageName)) {
          $imageName = Str::random(5) . '_' . $file_name;
        }
        // Di chuyển file vào thư mục img trên server
        $file->move(public_path('img'), $imageName);
      } else { // File không đúng định dạng hình ảnh thì trở về với thông báo lỗi
        return redirect()->back()->with('avatarMsg', 'File tải lên không đúng định dạng hình ảnh.');
      }
    }

    $user = new User();
    $user->username = $request->username;
    $user->password = Hash::make($request->password);
    //$user->confirm_password = $request->confirm_password;
    $user->email = $request->email;
    $user->phone_number = $request->phone_number;
    $user->city = $request->city;
    $user->avatar = $imageName;

    // $user = User::create([
    //     'username' => $request->input('username'),
    //     'password' => $hashed,
    //     'email' => $request->input('email'),
    //     'phone_number' => $request->input('phone_number'),
    //     'city' => $request->input('city'),
    //     'role_name' => $request->input('role_name') ?? 'user',
    //     'avatar' => $imageName,
    // ]);


    $res = $user->save();
    if ($res) {
      return back()->with('success', 'Bạn đã đăng ký tài khoản thành công.');
    } else {
      return back()->with('fail', 'Đăng ký tài khoản thất bại.');
    }
  }
}
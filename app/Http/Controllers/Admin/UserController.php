<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Str;

class UserController extends Controller
{
    public function index()
    {
        $perPage = 10;
        $users = User::paginate($perPage);

        return view('admin.all-users', compact('users'));
    }
    public function showCreateUser()
    {
        $roles = User::all()->pluck('role_name')->unique()->values()->all();
        return view('admin.create-user', compact('roles'));
    }
    public function createUser(Request $request)
    {
        $formData = $request->validate([
            'username' => 'required|max:20|unique:users',
            'password' => 'required|max:20',
            'confirm_password' => 'required|max:20',
            'email' => 'required|email',
            'phone_number' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/', 'max:10'],
            'city' => 'required|max:20',
            // 'role_name' => 'required',
        ], [
            'username.required' => 'Trường tên người dùng không được bỏ trống',
            'username.max' => 'Trường tên người dùng không được vượt quá :max ký tự',
            'username.unique' => 'Tên người dùng đã được dùng. Vui lòng nhập tên khác.',
            'password.required' => 'Trường mật khẩu không được bỏ trống',
            'password.max' => 'Trường mật khẩu không được vượt quá :max ký tự',
            'confirm_password.required' => 'Trường xác nhận mật khẩu không được bỏ trống',
            'confirm_password.max' => 'Trường xác nhận mật khẩu không được vượt quá :max ký tự',
            'email.required' => 'Trường email không được bỏ trống',
            'email.email' => 'Trường email không đúng định dạng',
            'phone_number.required' => 'Trường số điện thoại không được bỏ trống',
            'phone_number.regex' => 'Trường số điện thoại không đúng định dạng',
            'phone_number.max' => 'Trường số điện thoại không được vượt quá :max ký tự',
            'city.required' => 'Trường tỉnh thành phố không được bỏ trống',
            'city.max' => 'Trường tỉnh thành phố không được vượt quá :max ký tự',
            // 'role_name.required' => 'Trường quyền sử dụng không được bỏ trống',
        ]);

        $pwd_pattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        $pwd = $request->input('password');
        $confirm_pwd = $request->input('confirm_password');
        $username_pattern = "/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/";
        $usrename = $request->input('username');

        if (!preg_match($username_pattern, $usrename)) {
            return redirect()->back()->with('usernameMsg', 'Tên người dùng chỉ bao gồm ký tự, chữ số và ký tự _');
        }
        if (!preg_match($pwd_pattern, $pwd)) {
            return redirect()->back()->with('passwordMsg', 'Mật khẩu phải có ít nhất 8 ký tự, 1 chữ in hoa, 1 chữ in thường, 1 chữ số, và 1 ký tự đặc biệt.');
        }
        // kiểm tra mật khẩu xác nhận có giống mật khẩu không
        if (strcmp($confirm_pwd, $pwd) !== 0) {
            return redirect()->back()->with('confirm_passwordMsg', 'Mật khẩu xác nhận không đúng.');
        }

        // Mã hóa password 
        $hashed = Hash::make($pwd);

        // Xử lý file
        $isUploadAvatar = $request->hasFile('avatar');

        $imageName = 'no-avatar.jpg'; //file mặc định là hình no avartar
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

        $users = User::create([
            'username' => $request->input('username'),
            'password' => $hashed,
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'city' => $request->input('city'),
            'role_name' => $request->input('role_name') ?? 'user',
            'avatar' => $imageName,
        ]);

        if (empty($users))
            return redirect('/admin/create-user')->with('createFailed', 'Tạo người dùng thất bại.');

        return redirect('/admin/create-user')->with('createSuccess', 'Tạo người dùng thành công.');
    }
    public function showUpdateUser($username)
    {
        $user = User::find($username);
        if (empty($user))
            abort(404, 'Người dùng không tồn tại.');

        if ($user->role_name === "admin") {
            $roles = User::all()->pluck('role_name')->unique()->values()->all();
            return view('admin.update-user', compact('user', 'roles'));
        } else
            return view('update-profile', compact('user'));
    }
    public function updateUser(Request $request, $username)
    {
        $formData = $request->validate([
            'username' => 'required|max:20',
            'email' => 'required|email',
            'phone_number' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/', 'max:10'],
            'city' => 'required|max:20',
            // 'role_name' => 'required',
        ], [
            'username.required' => 'Trường tên người dùng không được bỏ trống',
            'username.max' => 'Trường tên người dùng không được vượt quá :max ký tự',
            'email.required' => 'Trường email không được bỏ trống',
            'email.email' => 'Trường email không đúng định dạng',
            'phone_number.required' => 'Trường số điện thoại không được bỏ trống',
            'phone_number.regex' => 'Trường số điện thoại không đúng định dạng',
            'phone_number.max' => 'Trường số điện thoại không được vượt quá :max ký tự',
            'city.required' => 'Trường tỉnh thành phố không được bỏ trống',
            'city.max' => 'Trường tỉnh thành phố không được vượt quá :max ký tự',
            // 'role_name.required' => 'Trường quyền sử dụng không được bỏ trống',
        ]);

        $username_pattern = "/^(?=.{2,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/";
        $usrename = $request->input('username');

        if (!preg_match($username_pattern, $usrename)) {
            return redirect()->back()->with('usernameMsg', 'Tên người dùng chỉ bao gồm ký tự, chữ số và ký tự _');
        }

        $findUser = User::where('username', $request->input('username'))
            ->where('username', '<>', $username)
            ->get();

        if (count($findUser) > 0)
            return redirect()->back()->with('usernameMsg', 'Tên người dùng đã tồn tại. Vui lòng chọn tên khác.');
        $user = User::find($username);
        $isUploadAvatar = $request->hasFile('avatar');

        $imageName = $user->avatar; //file hình ảnh của user
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

                // Xóa avatar cũ trong thư mục img trên server
                $path_image = "img/" . $imageName;
                if (file_exists(public_path($path_image)))
                    File::delete(public_path($path_image));

                // Di chuyển file vào thư mục img trên server
                $file->move(public_path('img'), $imageName);

            } else  // File không đúng định dạng hình ảnh thì trở về với thông báo lỗi
                return redirect()->back()->with('avatarMsg', 'File tải lên không đúng định dạng hình ảnh.');
        }

        $user->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'city' => $request->input('city'),
            'role_name' => $request->input('role_name') ?? 'user',
            'avatar' => $imageName,
        ]);

        return redirect('/admin/update-user/' . $request->input('username'))->with('updateSuccess', 'Cập nhật thông tin người dùng thành công');
    }
    public function deleteUser($username)
    {
        $user = User::find($username);
        if (empty($user))
            abort(404, 'Người dùng không tồn tại.');
        $isDeleted = $user->delete();
        if (!$isDeleted)
            return redirect()->back()->with('deleteFailed', 'Xóa loại sản phẩm mới thất bại.');
        return redirect()->back()->with('deleteSuccess', 'Xóa loại sản phẩm mới thành công.');
    }


    public function showProfile($username)
    {
        // Giả sử user cố định là admin
        // Sau khi có phần login rồi thì hiện page theo user có role admin đang đăng nhập trên hệ thống.
        $user = User::find($username);
        if (empty($user))
            abort(404, 'Người dùng không tồn tại!');
        else
            if ($user->role_name === "admin")
                return view('admin.admin-profile', compact('user'));
            else
                return view('user-profile', compact('user'));
    }
}
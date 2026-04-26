<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Danh sách người dùng
     */
    public function index()
    {
        $nguoidung = User::all();
        return view('admin.nguoidung.index', compact('nguoidung'));
    }

    /**
     * Form thêm người dùng
     */
    public function create()
    {
        return view('admin.nguoidung.them');
    }

    /**
     * Xử lý thêm mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'role' => ['required'],
            'password' => ['required', 'min:4', 'confirmed'], // Mật khẩu bắt buộc
        ]);

        $orm = new User();
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@'); // Lấy phần trước chữ @ làm username
        $orm->email = $request->email;
        $orm->password = Hash::make($request->password); // Mã hóa mật khẩu
        $orm->role = $request->role;
        $orm->save();

        return redirect()->route('admin.nguoidung')->with('status', 'Thêm người dùng thành công!');
    }

    /**
     * Form chỉnh sửa
     */
    public function edit($id)
    {
        $nguoidung = User::findOrFail($id);
        return view('admin.nguoidung.sua', compact('nguoidung'));
    }

    /**
     * Xử lý cập nhật
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,' . $id],
            'role' => ['required'],
            'password' => ['nullable', 'min:4', 'confirmed'], // nullable: Không nhập thì không đổi
        ]);

        $orm = User::findOrFail($id);
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        $orm->role = $request->role;
        
        // Nếu có nhập mật khẩu mới thì mới mã hóa và lưu
        if(!empty($request->password)) {
            $orm->password = Hash::make($request->password);
        }
        
        $orm->save();

        return redirect()->route('admin.nguoidung')->with('status', 'Cập nhật người dùng thành công!');
    }

    /**
     * Xóa người dùng
     */
    public function destroy($id)
    {
        $orm = User::findOrFail($id);
        $orm->delete();

        return redirect()->route('admin.nguoidung')->with('status', 'Đã xóa người dùng thành công!');
    }
}
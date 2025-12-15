<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Cần thêm để sử dụng Hash::make()

class UserController extends Controller
{
    //Display a listing of the resource.
    public function index(Request $request)
    {
       // 1. Lấy tham số đầu vào
        $status = $request->input('status');
        $keyword = $request->input('keyword');
        
        // 2. Bắt đầu query
        $query = User::query();

        // 3. Xử lý lọc theo trạng thái (status)
        if ($status === 'trash') {
            // Lấy các bản ghi đã xóa mềm (trong thùng rác)
            $query->onlyTrashed();
        } else {
            // Mặc định: chỉ lấy các bản ghi KHÔNG bị xóa mềm (ACTIVE users)
            $query->withoutTrashed();
            
            // 4. Xử lý tìm kiếm (keyword)
            if ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%');
                });
            }
        }
        
        // 5. Phân trang và thực thi query
        $users = $query->paginate(5)->withQueryString(); 
        
        // 6. Tính toán đếm trạng thái
        $count_user_active = User::withoutTrashed()->count(); // Đếm ACTIVE (không bao gồm trash)
        $count_user_trash = User::onlyTrashed()->count();      // Đếm TRASH (đã xóa mềm)
        $count = [$count_user_active, $count_user_trash];

        return view('admin.users.index', compact('users', 'keyword', 'count', 'status'));
    }


    //Show the form for creating a new resource.
    public function create()
    {
        return view('admin.users.create');
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email', // Đảm bảo email là duy nhất
            'password'  => 'required|min:8',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password), // mã hoá mật khẩu
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Tạo tài khoản thành công!');
    }

    //Display the specified resource.
    public function show(string $id)
    {
        //
    }

    //Show the form for editing the specified resource.
    public function edit(string $id)
    {
          $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, string $id)
    {
          $user = User::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            // Đảm bảo email là duy nhất, trừ chính user này
            'email'     => 'required|email|unique:users,email,' . $user->id, 
            'password'  => 'nullable|min:8', // Đặt min length cho mật khẩu nếu có nhập
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        // nếu có mật khẩu mới → cập nhật
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật thành công!');
    }

    //Remove the specified resource from storage.
    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->route('admin.users.index')->with('success', 'Vô hiệu hóa user thành công!');
    }

    // Khôi phục
    public function restore($id) 
    { 
        $user = User::onlyTrashed()->where('id', $id)->first(); 
        if (!$user) { 
            return redirect()->back()->with('error', 'Tài khoản không tồn tại hoặc không nằm trong thùng rác.'); 
        } 
        $user->restore(); return redirect()->back()->with('success', 'Khôi phục tài khoản thành công!'); 
    }
}
<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /** ================================
     *  Hiển thị danh sách Category
     *  ================================ */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $status  = $request->status;

        // Query theo trạng thái
        if ($status == 'trash') {
            $query = Category::onlyTrashed();
        } else {
            $query = Category::query();
        }

        // Tìm kiếm
        if ($keyword) {
            $query->where('TYPE', 'LIKE', "%$keyword%");
        }

        // Phân trang
        $category = $query->orderBy('ID', 'DESC')
                          ->paginate(7)
                          ->withQueryString();

        // Đếm số lượng
        $count = [
            'active' => Category::count(),
            'trash'  => Category::onlyTrashed()->count(),
        ];

        return view('admin.products.category', compact('category', 'keyword', 'count', 'status'));
    }


    /** ================================
     *  Form tạo Category
     *  ================================ */
    public function create()
    {
        return view('admin.products.createCategory');
    }


    /** ================================
     *  Lưu Category mới
     *  ================================ */
    public function store(Request $request)
    {
        $request->validate([
            'TYPE'        => 'required|string|max:190|unique:category,TYPE',
            'DESCRIPTION' => 'nullable|string',
            'ACTIVE_FLAG' => 'required|integer|in:0,1',
        ]);

        Category::create([
            'TYPE'        => $request->TYPE,
            'DESCRIPTION' => $request->DESCRIPTION,
            'ACTIVE_FLAG' => $request->ACTIVE_FLAG,
            'CREATE_DATE' => now(),
            'UPDATE_DATE' => now(),
        ]);

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Thêm category thành công!');
    }


    /** ================================
     *  Form sửa Category
     *  ================================ */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.products.editCategory', compact('category'));
    }


    /** ================================
     *  Cập nhật Category
     *  ================================ */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'TYPE'        => "required|string|max:190|unique:category,TYPE,{$id},ID",
            'DESCRIPTION' => 'nullable|string',
            'ACTIVE_FLAG' => 'required|integer|in:0,1',
        ]);

        $category->update([
            'TYPE'        => $request->TYPE,
            'DESCRIPTION' => $request->DESCRIPTION,
            'ACTIVE_FLAG' => $request->ACTIVE_FLAG,
            'UPDATE_DATE' => now(),
        ]);

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Cập nhật category thành công!');
    }


    /** ================================
     *  Xóa (Soft Delete)
     *  ================================ */
    public function destroy(string $id)
    {
        try {
            Category::where('ID', $id)->delete();

            return redirect()
                ->route('admin.category.index')
                ->with('success', 'Xóa category thành công!');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.category.index')
                ->with('error', 'Không thể xoá vì category đang được sử dụng trong sản phẩm!');
        }
    }


    /** ================================
     *  Xử lý hàng loạt (delete / restore)
     *  ================================ */
    public function action(Request $request)
    {
        $act = $request->act;
        $list_check = $request->list_check;

        if (!$list_check) {
            return redirect()
                ->route('admin.products.category')
                ->with('error', 'Vui lòng chọn ít nhất một danh mục.');
        }

        // Vô hiệu hóa (xóa mềm)
        if ($act == 'delete') {
            Category::whereIn('ID', $list_check)->delete();

            return redirect()
                ->route('admin.products.category')
                ->with('success', 'Đã đưa vào thùng rác.');
        }

        // Khôi phục
        if ($act == 'restore') {
            Category::onlyTrashed()
                    ->whereIn('ID', $list_check)
                    ->restore();

            return redirect()
                ->route('admin.products.category')
                ->with('success', 'Đã khôi phục danh mục.');
        }

        return redirect()
            ->route('admin.products.category')
            ->with('error', 'Hành động không hợp lệ.');
    }
}

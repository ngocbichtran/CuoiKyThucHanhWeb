<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //  Hiển thị danh sách Category
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
                          ->paginate(6)
                          ->withQueryString();

        // Đếm số lượng
        $count = [
            'active' => Category::withoutTrashed()->count(),
            'trash'  => Category::onlyTrashed()->count(),
        ];

        return view('admin.products.category', compact('category', 'keyword', 'count', 'status'));
    }


    //Form tạo Category
    public function create()
    {
        return view('admin.products.createCategory');
    }


    // Lưu Category mới
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


    //Form sửa Category
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.products.editCategory', compact('category'));
    }


    //Cập nhật Category
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


    //Xóa (Soft Delete)
    public function destroy($id)
        {
            $category = Category::findOrFail($id);

            if ($category->products()->exists()) {
                return redirect()
                    ->route('admin.category.index')
                    ->with('error', 'Danh mục đang có sản phẩm, không thể xoá.');
            }

            $category->delete();

            return redirect()
                ->route('admin.category.index')
                ->with('success', 'Đã đưa danh mục vào thùng rác.');
        }

      public function restore($id) 
    { 
        $category = Category::onlyTrashed()->where('id', $id)->first(); 
        if (!$category) { 
            return redirect()->back()->with('error', 'Loai sản phẩm không tồn tại hoặc không nằm trong thùng rác.'); 
        } 
        $category->restore(); return redirect()->back()->with('success', 'Khôi phục loại sản phẩm thành công!'); 
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /** ================================
     *  Hiển thị danh sách
     *  ================================ */
public function index(Request $request)
{
    $keyword = $request->input('keyword');

    $categories = Category::when($keyword, function ($query) use ($keyword) {
        $query->where('name', 'like', '%' . $keyword . '%');
    })
    ->paginate(7);

    return view('admin.products.category', compact('categories', 'keyword'));
}


    /** ================================
     *  Form tạo category
     *  ================================ */
    public function create()
    {
        return view('admin.products.createCategory');
    }

    /** ================================
     *  Lưu category mới
     *  ================================ */
    public function store(Request $request)
    {
        $request->validate([
            'TYPE'        => 'required',
            'DESCRIPTION' => 'nullable',
            'ACTIVE_FLAG' => 'required'
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
     *  Xem chi tiết (nếu cần)
     *  ================================ */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.products.category', compact('category'));
    }

    /** ================================
     *  Form sửa category
     *  ================================ */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.products.editCategory', compact('category'));
    }

    /** ================================
     *  Cập nhật category
     *  ================================ */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

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
     *  Xóa category
     *  ================================ */
    public function destroy(string $id)
    {
        try {
            Category::where('ID', $id)->delete();

            return redirect()
                ->route('admin.category.index')
                ->with('success', 'Xóa category thành công!');
        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()
                ->route('admin.category.index')
                ->with('error', 'Không thể xoá vì category đang được sử dụng trong sản phẩm!');
        }
    }
}

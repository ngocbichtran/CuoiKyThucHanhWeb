<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status  = $request->input('status');
        $keyword = $request->input('keyword');

        // Bắt đầu query
        $query = Product::query();

        // Lọc trạng thái
        if ($status === 'trash') {
            $query->onlyTrashed();
        } else {
            $query->withoutTrashed();

            // Tìm kiếm
            if ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('NAME', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('DESCRIPTION', 'LIKE', '%' . $keyword . '%');
                });
            }
        }

        // Phân trang
        $products = $query->paginate(7)->withQueryString();

        // Đếm trạng thái
        $count_product_active = Product::withoutTrashed()->count();
        $count_product_trash  = Product::onlyTrashed()->count();
        $count = [$count_product_active, $count_product_trash];

        return view('admin.products.index', compact('products', 'keyword', 'count', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryList = Category::all();
        return view('admin.products.create', compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'CATE_ID'     => 'required|integer|exists:category,ID',
            'NAME'        => 'required|string|max:190',
            'DESCRIPTION' => 'nullable|string',
            'IMG_URL'     => 'nullable|string|max:200',
            'ACTIVE_FLAG' => 'required|integer|in:0,1',
        ]);

        Product::create([
            'CATE_ID'     => $request->CATE_ID,
            'NAME'        => $request->NAME,
            'DESCRIPTION' => $request->DESCRIPTION,
            'IMG_URL'     => $request->IMG_URL,
            'ACTIVE_FLAG' => $request->ACTIVE_FLAG,
            'CREATE_DATE' => now(),
        ]);

        return redirect()->route('admin.product.index')
            ->with('success', 'Thêm sản phẩm thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'CATE_ID'     => 'required|integer|exists:category,ID',
            'NAME'        => 'required|string|max:190',
            'DESCRIPTION' => 'nullable|string',
            'IMG_URL'     => 'nullable|string|max:200',
            'ACTIVE_FLAG' => 'required|integer|in:0,1',
        ]);

        $product->update([
            'CATE_ID'     => $request->CATE_ID,
            'NAME'        => $request->NAME,
            'DESCRIPTION' => $request->DESCRIPTION,
            'IMG_URL'     => $request->IMG_URL,
            'ACTIVE_FLAG' => $request->ACTIVE_FLAG,
            'UPDATE_DATE' => now(),
        ]);

        return redirect()->route('admin.product.index')
            ->with('success', 'Cập nhật sản phẩm thành công!');
    }

    /**
     * Soft delete sản phẩm.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.product.index')
            ->with('success', 'Đã chuyển sản phẩm vào thùng rác!');
    }

    /**
     * Bulk Actions (Delete / Restore)
     */
    public function action(Request $request)
    {
        $act        = $request->input('act');
        $list_check = $request->input('list_check');

        // Không có checkbox nào
        if (!$list_check) {
            return redirect()->route('admin.product.index')
                ->with('error', 'Vui lòng chọn ít nhất một sản phẩm.');
        }

        // Hành động delete (soft delete)
        if ($act == 'delete') {
            Product::destroy($list_check);

            return redirect()->route('admin.product.index')
                ->with('success', 'Đã chuyển các sản phẩm vào thùng rác.');
        }

        // Hành động restore
        if ($act == 'restore') {
            Product::onlyTrashed()
                ->whereIn('ID', $list_check)
                ->restore();

            return redirect()->route('admin.product.index')
                ->with('success', 'Đã khôi phục các sản phẩm.');
        }

        return redirect()->route('admin.product.index')
            ->with('error', 'Hành động không hợp lệ.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;   // ⚠ Thêm dòng này để dùng Order

class ShopController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm ngoài shop.
     */
    public function index()
    {
        $products = Product::where('ACTIVE_FLAG', 1)
                           ->orderBy('CREATE_DATE', 'desc')
                           ->paginate(12);

        return view('layouts.shop', compact('products'));
    }

    /**
     * Xử lý đặt hàng.
     */
    public function order(Request $request)
    {
        // Nếu chưa đăng nhập → không cho đặt hàng
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đặt hàng.');
        }

        $request->validate([
            'product_id' => 'required|exists:product_info,ID',
            'so_luong'   => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);

        // Tạo dữ liệu đơn hàng
        Order::create([
            'product_id' => $product->ID,
            'name'       => $product->NAME,
            'so_luong'   => $request->so_luong,
            'don_gia'    => $product->PRICE,
            'user_id'    => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Đặt hàng thành công!');
    }

    public function create() {}
    public function store(Request $request) {}
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}

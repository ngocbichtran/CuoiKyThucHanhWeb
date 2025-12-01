<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // ============================
    // HIỂN THỊ DANH SÁCH
    // ============================
    public function index(Request $request)
    {
        $keyword  = $request->input('keyword');
        $delivery = $request->input('delivery', 'all');

        $query = Order::query();

        // Lọc trạng thái
        if ($delivery == 'delivered') {     
            $query->where('status', 1);
        }
        elseif ($delivery == 'pending') {       
            $query->where('status', 0);
        }

        // Tìm kiếm
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('customer_name', 'LIKE', "%$keyword%")
                  ->orWhere('customer_phone', 'LIKE', "%$keyword%")
                  ->orWhere('customer_address', 'LIKE', "%$keyword%");
            });
        }

        // Phân trang
        $orders = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();

        // Đếm đơn theo trạng thái
        $count = [
            'delivered' => Order::where('status', 1)->count(),
            'pending'   => Order::where('status', 0)->count(),
        ];

        return view('admin.orders.index', compact('orders', 'keyword', 'delivery', 'count'));
    }

    // ============================
    // TẠO ĐƠN HÀNG (SHOP)
    // ============================
    public function store(Request $request)
    {
        $order = Order::create([
            'customer_name'    => $request->customer_name,
            'customer_phone'   => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total_price'      => $request->total_price,
            'status'           => 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đặt hàng thành công!',
            'order'   => $order
        ]);
    }

    // ============================
    // TRANG CHI TIẾT
    // ============================
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // ============================
    // CẬP NHẬT TRẠNG THÁI
    // ============================
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->status = (int) $request->status;
        $order->save();

        return back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    // ============================
    // UPDATE BẰNG FORM
    // ============================
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $order->status = (int) $request->status;
        $order->save();

        return back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    // ============================
    // XÓA MỀM
    // ============================
    public function destroy(string $id)
    {
        Order::findOrFail($id)->delete();
        return back()->with('success', 'Đã chuyển đơn vào thùng rác!');
    }

    // ============================
    // BULK ACTIONS
    // ============================
    public function action(Request $request)
    {
        $act        = $request->input('act');
        $list_check = $request->input('list_check');

        if (!$list_check) {
            return back()->with('error', 'Vui lòng chọn ít nhất một đơn hàng.');
        }

        if ($act === 'delete') {
            Order::destroy($list_check);
            return back()->with('success', 'Đã chuyển các đơn hàng vào thùng rác.');
        }

        if ($act === 'restore') {
            Order::onlyTrashed()
                ->whereIn('id', $list_check)
                ->restore();

            return back()->with('success', 'Đã khôi phục các đơn hàng.');
        }

        return back()->with('error', 'Hành động không hợp lệ.');
    }
}

@extends('layouts.shop')

@section('content')
<div class="max-w-5xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">🛒 Giỏ hàng của bạn</h2>

    @if($orders->count() == 0)
        <p class="text-gray-500">Chưa có sản phẩm nào trong giỏ hàng.</p>
    @else
        <table class="w-full border-collapse bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Sản phẩm</th>
                    <th class="p-3 text-center">Số lượng</th>
                    <th class="p-3 text-right">Đơn giá</th>
                    <th class="p-3 text-right">Thành tiền</th>
                    <th class="p-3 text-center">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-t">
                    <td class="p-3">{{ $order->name }}</td>
                    <td class="p-3 text-center">{{ $order->so_luong }}</td>
                    <td class="p-3 text-right">
                        {{ number_format($order->don_gia) }} đ
                    </td>
                    <td class="p-3 text-right font-semibold">
                        {{ number_format($order->so_luong * $order->don_gia) }} đ
                    </td>
                    <td class="p-3 text-center">
                        @if($order->status == 0)
                            <span class="text-yellow-600">Chưa giao</span>
                        @else
                            <span class="text-green-600">Đã giao</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

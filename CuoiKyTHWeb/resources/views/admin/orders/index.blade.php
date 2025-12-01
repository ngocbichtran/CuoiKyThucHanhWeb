@extends('layouts.admin')

@section('content')

<div class="d-flex align-items-start justify-content-between mb-4" style="padding: 0 50px;">
    <div class="table-wrapper">

        <!-- Bộ lọc trạng thái -->
        <div class="d-flex align-items-center justify-content-between mb-4">

            <h3 class="page-title">Quản lý đơn hàng</h3>

            <div class="d-flex">
                <a href="{{ route('admin.orders.index', ['delivery' => 'all']) }}"
                   class="btn btn-outline-secondary me-2 {{ $delivery == 'all' ? 'active' : '' }}">
                    Tất cả ({{ $count['pending'] + $count['delivered'] }})
                </a>

                <a href="{{ route('admin.orders.index', ['delivery' => 'delivered']) }}"
                   class="btn btn-outline-success me-2 {{ $delivery == 'delivered' ? 'active' : '' }}">
                    Đã giao ({{ $count['delivered'] }})
                </a>

                <a href="{{ route('admin.orders.index', ['delivery' => 'pending']) }}"
                   class="btn btn-outline-warning text-dark {{ $delivery == 'pending' ? 'active' : '' }}">
                    Chưa giao ({{ $count['pending'] }})
                </a>
            </div>

            <!-- Form tìm kiếm -->
            <form method="GET" action="{{ route('admin.orders.index') }}" class="d-flex">
                <input type="text"
                       name="keyword"
                       value="{{ $keyword ?? '' }}"
                       class="form-control"
                       placeholder="Tìm theo tên / SĐT / địa chỉ..."
                       style="width:250px;">

                <button class="btn btn-primary ms-2">Tìm</button>
            </form>

        </div>

        <!-- Thông báo -->
        <div class="px-5">
            @if($keyword && $orders->total() == 0)
                <div class="alert alert-warning py-2 mb-2">
                    Không tìm thấy kết quả cho: <strong>{{ $keyword }}</strong>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success py-2 mb-2">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger py-2 mb-2">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <!-- Bảng đơn hàng -->
        <div class="table-responsive d-flex justify-content-center mt-3">

            <table class="table table-striped table-hover text-center align-middle shadow-sm"
                   style="width: 95%; table-layout: fixed; border-radius: 10px; overflow: hidden;">

                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>ID SP</th>
                        <th>Tên sản phẩm</th>
                        <th>SL</th>
                        <th>Đơn giá</th>
                        <th>ID KH</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td><strong>{{ $order->id }}</strong></td>

                            <td>{{ $order->product_id }}</td>

                            <td style="white-space: normal; word-break: break-word;">
                                <strong>{{ $order->name }}</strong>
                            </td>

                            <td>{{ $order->so_luong }}</td>

                            <td class="text-primary fw-bold">
                                {{ number_format($order->don_gia) }} đ
                            </td>

                            <td>{{ $order->user_id }}</td>

                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</td>

                            <!-- TRẠNG THÁI + NÚT CHUYỂN -->
                            <td class="text-center">
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}"
                                      method="POST"
                                      class="mt-2">

                                    @csrf
                                    @method('PUT')

                                    @if ($order->status == 0)

                                        <input type="hidden" name="status" value="1">

                                        <button class="btn btn-outline-success btn-sm w-100 d-flex align-items-center justify-content-center gap-1"
                                                style="border-radius: 8px; font-weight: 600;">
                                            <i class="bi bi-check-circle"></i>
                                            Đánh dấu đã giao
                                        </button>

                                    @else

                                        <p>Đã Giao</p>

                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>

<!-- Phân trang -->
<div class="d-flex justify-content-center mt-3">
    {{ $orders->links('pagination::bootstrap-5') }}
</div>

@endsection

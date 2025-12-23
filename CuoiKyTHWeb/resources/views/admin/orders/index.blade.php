@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4 d-flex flex-column" style="min-height: calc(100vh - 120px);">

    <!-- HEADER + FILTER -->
    <div>
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">

            <h3 class="fw-bold mb-2 mb-md-0">Quản lý đơn hàng</h3>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.orders.index', ['delivery' => 'all']) }}"
                   class="btn btn-outline-secondary {{ $delivery == 'all' ? 'active' : '' }}">
                    Tất cả ({{ $count['pending'] + $count['delivered'] }})
                </a>

                <a href="{{ route('admin.orders.index', ['delivery' => 'delivered']) }}"
                   class="btn btn-outline-success {{ $delivery == 'delivered' ? 'active' : '' }}" style="margin-left:20px;margin-right:20px">
                    Đã giao ({{ $count['delivered'] }})
                </a>

                <a href="{{ route('admin.orders.index', ['delivery' => 'pending']) }}"
                   class="btn btn-outline-warning text-dark {{ $delivery == 'pending' ? 'active' : '' }}">
                    Chưa giao ({{ $count['pending'] }})
                </a>
            </div>


        </div>

        <!-- ALERT -->
        @if($keyword && $orders->total() == 0)
            <div class="alert alert-warning py-2">
                Không tìm thấy kết quả cho: <strong>{{ $keyword }}</strong>
            </div>
        @endif
    </div>

    <!-- TABLE (CO GIÃN) -->
    <div class="card shadow-sm border-0 flex-grow-1">
        <div class="card-body p-0 d-flex flex-column">

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>ID</th>
                            <th>ID SP</th>
                            <th class="text-start">Tên sản phẩm</th>
                            <th>SL</th>
                            <th>Đơn giá</th>
                            <th>ID KH</th>
                            <th>Ngày đặt</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->product_id }}</td>
                            <td class="text-start">{{ $order->name }}</td>
                            <td>{{ $order->so_luong }}</td>
                            <td class="fw-bold text-primary">{{ number_format($order->don_gia) }} đ</td>
                            <td>{{ $order->user_id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if ($order->status == 0)
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="1">
                                        <button class="btn btn-outline-success btn-sm w-100">
                                            Đã giao
                                        </button>
                                    </form>
                                @else
                                    <span class="badge bg-success">Đã giao</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- PAGINATION - DÍNH ĐÁY -->
    <div class="mt-auto pt-3">
        <div class="d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>

@endsection

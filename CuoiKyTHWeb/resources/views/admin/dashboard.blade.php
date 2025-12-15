@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h3 class="mb-4 fw-bold text-dark">Bảng điều khiển tổng quan</h3>

    <div class="row mb-5">
        
        <!-- Tổng đơn hàng thành công -->
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
            <div class="card bg-primary text-white shadow-sm h-100">
                <div class="card-header border-0 fw-bold">ĐƠN HÀNG THÀNH CÔNG</div>

                <div class="card-body">
                    <a href="{{ route('admin.orders.index', ['delivery' => 'delivered']) }}"
                    class="btn btn-outline-light">
                        Tổng: {{ $count['delivered'] }}
                    </a>

                    <p class="card-text mt-2">Đơn hàng giao dịch thành công</p>
                </div>
            </div>
        </div>

        <!-- Tổng sản phẩm đang bán -->
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
            <div class="card bg-success text-white shadow-sm h-100">
                <div class="card-header border-0 fw-bold">TỔNG SẢN PHẨM</div>
                <div class="card-body">
                    <a href="{{ route('admin.product.index', ['status' => 'active']) }}"
                    class="btn btn-outline-light">
                        Sản phẩm ({{ $countProducts['active'] }})
                    </a>
                    <p class="card-text">Tổng số sản phẩm</p>
                </div>
            </div>
        </div>

        <!-- Tổng người dùng  -->
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
            <div class="card bg-info text-white shadow-sm h-100">
                <div class="card-header border-0 fw-bold">NGƯỜI DÙNG</div>
                <div class="card-body">
                    <a href="{{ route('admin.users.index', ['status' => 'active']) }}"
                    class="btn btn-outline-light">
                        Kích hoạt ({{ $countUsers['active'] }})
                    </a>
                    <p class="card-text">Người dùng đăng ký trong 30 ngày</p>
                </div>
            </div>
        </div>
    </div>
   
        </div>
    </div>
</div>
@endsection
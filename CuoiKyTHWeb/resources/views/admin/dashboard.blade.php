@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h3 class="mb-4 fw-bold text-dark">Bảng Điều Khiển Tổng Quan (Tĩnh)</h3>

    <!-- Khu vực 1: ANALYTICS - Các Chỉ Số Chính -->
    <div class="row mb-5">
        
        <!-- Tổng Đơn Hàng Thành Công -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
            <div class="card bg-primary text-white shadow-sm h-100">
                <div class="card-header border-0 fw-bold">ĐƠN HÀNG THÀNH CÔNG</div>
                <div class="card-body">
                    <h4 class="card-title fw-bold">2.680</h4>
                    <p class="card-text">Đơn hàng giao dịch thành công</p>
                </div>
            </div>
        </div>

        <!-- Tổng Sản Phẩm Đang Bán -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
            <div class="card bg-success text-white shadow-sm h-100">
                <div class="card-header border-0 fw-bold">TỔNG SẢN PHẨM</div>
                <div class="card-body">
                    <h4 class="card-title fw-bold">580</h4>
                    <p class="card-text">Tổng số sản phẩm đang bày bán</p>
                </div>
            </div>
        </div>

        <!-- Tổng Doanh Số -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
            <div class="card bg-warning text-dark shadow-sm h-100">
                <div class="card-header border-0 fw-bold">DOANH SỐ THÁNG</div>
                <div class="card-body">
                    <h4 class="card-title fw-bold">500 Triệu</h4>
                    <p class="card-text">Doanh số đạt được tháng này</p>
                </div>
            </div>
        </div>
        
        <!-- Tổng Người Dùng Mới -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
            <div class="card bg-info text-white shadow-sm h-100">
                <div class="card-header border-0 fw-bold">NGƯỜI DÙNG MỚI</div>
                <div class="card-body">
                    <h4 class="card-title fw-bold">125</h4>
                    <p class="card-text">Người dùng đăng ký trong 30 ngày</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->

    <div class="row">
        <!-- Bảng 1: ĐƠN HÀNG MỚI NHẤT -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header fw-bold bg-light">
                    ĐƠN HÀNG MỚI CẦN XỬ LÝ
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Mã</th>
                                    <th style="width: 35%;">Khách hàng</th>
                                    <th style="width: 25%;">Giá trị</th>
                                    <th style="width: 30%;">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Dữ liệu tĩnh cho 5 đơn hàng mới nhất --}}
                                <tr>
                                    <td>#1215</td>
                                    <td>
                                        <strong>Nguyễn A</strong> <br>
                                        <small class="text-muted">098xxxxxx</small>
                                    </td>
                                    <td>10.500.000₫</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">Đang xử lý</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1214</td>
                                    <td>
                                        <strong>Trần B</strong> <br>
                                        <small class="text-muted">097yyyyyy</small>
                                    </td>
                                    <td>2.150.000₫</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">Đang xử lý</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1213</td>
                                    <td>
                                        <strong>Phạm C</strong> <br>
                                        <small class="text-muted">090zzzzzz</small>
                                    </td>
                                    <td>5.600.000₫</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">Đang xử lý</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1212</td>
                                    <td>
                                        <strong>Lê D</strong> <br>
                                        <small class="text-muted">091aaaaaa</small>
                                    </td>
                                    <td>1.200.000₫</td>
                                    <td>
                                        <span class="badge bg-success">Đã giao</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1211</td>
                                    <td>
                                        <strong>Huỳnh E</strong> <br>
                                        <small class="text-muted">092bbbbbb</small>
                                    </td>
                                    <td>8.990.000₫</td>
                                    <td>
                                        <span class="badge bg-danger">Đã hủy</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="#" class="btn btn-sm btn-outline-secondary">Xem tất cả đơn hàng</a>
                </div>
            </div>
        </div>

        <!-- Bảng 2: SẢN PHẨM MỚI NHẤT -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header fw-bold bg-light">
                    SẢN PHẨM MỚI ĐƯỢC THÊM
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 15%;">Mã SP</th>
                                    <th style="width: 45%;">Tên sản phẩm</th>
                                    <th style="width: 20%;">Loại</th>
                                    <th style="width: 20%;">Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Dữ liệu tĩnh cho 5 sản phẩm mới nhất --}}
                                <tr>
                                    <td>#P005</td>
                                    <td><a href="#" class="text-decoration-none">Tai nghe Bluetooth X10</a></td>
                                    <td>Phụ kiện</td>
                                    <td>850.000₫</td>
                                </tr>
                                <tr>
                                    <td>#P004</td>
                                    <td><a href="#" class="text-decoration-none">Samsung Galaxy S23</a></td>
                                    <td>Điện thoại</td>
                                    <td>15.990.000₫</td>
                                </tr>
                                <tr>
                                    <td>#P003</td>
                                    <td><a href="#" class="text-decoration-none">Ốp lưng IPhone 14</a></td>
                                    <td>Phụ kiện</td>
                                    <td>120.000₫</td>
                                </tr>
                                <tr>
                                    <td>#P002</td>
                                    <td><a href="#" class="text-decoration-none">MacBook Pro M3</a></td>
                                    <td>Laptop</td>
                                    <td>35.000.000₫</td>
                                </tr>
                                <tr>
                                    <td>#P001</td>
                                    <td><a href="#" class="text-decoration-none">Chuột không dây Logitech</a></td>
                                    <td>Phụ kiện</td>
                                    <td>450.000₫</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="#" class="btn btn-sm btn-outline-secondary">Xem tất cả sản phẩm</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
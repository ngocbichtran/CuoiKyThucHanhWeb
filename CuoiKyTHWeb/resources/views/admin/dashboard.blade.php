@extends('layouts.admin')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                <div class="card-body">
                    <h5 class="card-title">2.680</h5>
                    <p class="card-text">Đơn hàng giao dịch thành công</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-header">ĐANG XỬ LÝ</div>
                <div class="card-body">
                    <h5 class="card-title">10</h5>
                    <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12 mb-3">
            <div class="card text-white bg-success">
                <div class="card-header">DOANH SỐ</div>
                <div class="card-body">
                    <h5 class="card-title">2.5 tỷ</h5>
                    <p class="card-text">Doanh số hệ thống</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12 mb-3">
            <div class="card text-white bg-dark">
                <div class="card-header">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title">125</h5>
                    <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">
        <div class="card-header fw-bold">
            ĐƠN HÀNG MỚI
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã</th>
                        <th>Khách hàng</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá trị</th>
                        <th>Trạng thái</th>
                        <th>Thời gian</th>
                        <th>Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <td>1212</td>
                        <td>
                            Phan Văn Cương <br>
                            0988859692
                        </td>
                        <td><a href="#">Samsung Galaxy A51 (8GB/128GB)</a></td>
                        <td>1</td>
                        <td>7.790.000₫</td>
                        <td><span class="badge bg-warning text-dark">Đang xử lý</span></td>
                        <td>26/06/2020 14:00</td>
                        <td>
                            <a href="#" class="btn btn-success btn-sm rounded-0 text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <!-- Các dòng khác tương tự -->
                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
    // Bootstrap 5 Tooltip
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
@endsection

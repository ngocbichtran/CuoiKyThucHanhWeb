@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <!-- HEADER -->
        <div class="card-header bg-white border-0 pb-0">
            <h5 class="fw-bold text-dark mb-0">
                ➕ Thêm sản phẩm
            </h5>
        </div>

        <!-- BODY -->
        <div class="card-body">
            <form action="{{ route('admin.product.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <!-- CỘT TRÁI -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Loại sản phẩm</label>
                            <select name="CATE_ID" class="form-control">
                                <option value="">-- Chọn loại --</option>
                                @foreach ($categoryList as $cate)
                                    <option value="{{ $cate->ID }}">
                                        {{ $cate->TYPE }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên sản phẩm</label>
                            <input type="text" name="NAME" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Đơn giá</label>
                            <input type="number" name="PRICE" class="form-control" >
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Trạng thái</label>
                            <select name="ACTIVE_FLAG" class="form-control">
                                <option value="1">Đã bày bán</option>
                                <option value="0">Chưa bày bán</option>
                            </select>
                        </div>
                    </div>

                    <!-- CỘT PHẢI -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mô tả</label>
                            <textarea name="DESCRIPTION" class="form-control"
                                      rows="6"
                                      placeholder="Mô tả chi tiết sản phẩm"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">IMG URL</label>
                            <input type="text" name="IMG_URL"
                                   class="form-control"
                                  >
                        </div>
                    </div>
                </div>

                <!-- ACTION -->
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-success px-5">
                        💾 Lưu sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

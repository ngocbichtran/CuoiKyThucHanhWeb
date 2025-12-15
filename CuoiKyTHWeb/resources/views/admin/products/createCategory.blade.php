@extends('layouts.admin')

@section('content')
<div class="container py-3">
    <div class="card shadow-sm border-0" style="max-width: 500px; margin: 0 auto;">
        
        <!-- HEADER -->
        <div class="card-header border-0">
            <h5 class="fw-bold mb-0">➕ Thêm loại sản phẩm</h5>
        </div>

        <!-- BODY -->
        <div class="card-body">
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tên loại</label>
                    <input type="text"
                           name="TYPE"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Mô tả</label>
                    <textarea name="DESCRIPTION"
                              class="form-control"
                              rows="4"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Trạng thái</label>
                    <select name="ACTIVE_FLAG" class="form-control">
                        <option value="1">Đã bày bán</option>
                        <option value="0">Chưa bày bán</option>
                    </select>
                </div>

                <!-- BUTTON -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-5">
                        Lưu loại
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

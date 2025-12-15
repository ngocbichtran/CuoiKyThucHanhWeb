@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 800px;">

        <!-- HEADER -->
        <div class="card-header border-0">
            <h5 class="fw-bold mb-0">✏️ Cập nhật loại sản phẩm</h5>
        </div>

        <!-- BODY -->
        <div class="card-body">
            <form action="{{ route('admin.category.update', $category->ID) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- ID ẩn --}}
                <input type="hidden" name="ID" value="{{ $category->ID }}">

                {{-- HIỂN THỊ LỖI --}}
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row g-4">
                    <!-- CỘT TRÁI -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">ID</label>
                            <input type="text"
                                   class="form-control bg-light"
                                   value="{{ $category->ID }}"
                                   readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên loại</label>
                            <input type="text"
                                   name="TYPE"
                                   class="form-control"
                                   value="{{ old('TYPE', $category->TYPE) }}">
                        </div>
                    </div>

                    <!-- CỘT PHẢI -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Trạng thái</label>
                            <select name="ACTIVE_FLAG" class="form-control">
                                <option value="1" {{ old('ACTIVE_FLAG', $category->ACTIVE_FLAG) == 1 ? 'selected' : '' }}>
                                    Đã bày bán
                                </option>
                                <option value="0" {{ old('ACTIVE_FLAG', $category->ACTIVE_FLAG) == 0 ? 'selected' : '' }}>
                                    Chưa bày bán
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mô tả</label>
                            <textarea name="DESCRIPTION"
                                      class="form-control"
                                      rows="4">{{ old('DESCRIPTION', $category->DESCRIPTION) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- ACTION -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary">
                        Quay lại
                    </a>

                    <button type="submit" class="btn btn-success px-4">
                        Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

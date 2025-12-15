@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 900px;">

        <!-- HEADER -->
        <div class="card-header border-0">
            <h5 class="fw-bold mb-0">✏️ Cập nhật sản phẩm</h5>
        </div>

        <!-- BODY -->
        <div class="card-body">
            <form action="{{ route('admin.product.update', $product->ID) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- LỖI --}}
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
                            <label class="form-label fw-semibold">Loại sản phẩm</label>
                            <select name="CATE_ID" class="form-control">
                                @foreach ($categories as $cate)
                                    <option value="{{ $cate->ID }}"
                                        {{ old('CATE_ID', $product->CATE_ID) == $cate->ID ? 'selected' : '' }}>
                                        {{ $cate->TYPE }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">IMG URL</label>
                            <input type="text"
                                   name="IMG_URL"
                                   class="form-control"
                                   value="{{ old('IMG_URL', $product->IMG_URL) }}"
                                   placeholder="https://example.com/image.jpg">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giá sản phẩm</label>
                            <input type="number"
                                   name="PRICE"
                                   class="form-control"
                                   value="{{ old('PRICE', $product->PRICE) }}">
                        </div>
                    </div>

                    <!-- CỘT PHẢI -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên sản phẩm</label>
                            <input type="text"
                                   name="NAME"
                                   class="form-control"
                                   value="{{ old('NAME', $product->NAME) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Trạng thái</label>
                            <select name="ACTIVE_FLAG" class="form-control">
                                <option value="1" {{ old('ACTIVE_FLAG', $product->ACTIVE_FLAG) == 1 ? 'selected' : '' }}>
                                    Đã bày bán
                                </option>
                                <option value="0" {{ old('ACTIVE_FLAG', $product->ACTIVE_FLAG) == 0 ? 'selected' : '' }}>
                                    Chưa bày bán
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mô tả</label>
                            <textarea name="DESCRIPTION"
                                      class="form-control"
                                      rows="3">{{ old('DESCRIPTION', $product->DESCRIPTION) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- ACTION -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">
                        Quay lại
                    </a>

                    <button type="submit" class="btn btn-success px-5">
                        Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

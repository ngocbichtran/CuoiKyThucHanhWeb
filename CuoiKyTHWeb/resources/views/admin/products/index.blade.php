@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4 py-4 d-flex flex-column"
     style="min-height: calc(100vh - 100px);">

    <div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-primary mb-0">
                <i class="fa-solid fa-boxes-stacked me-2"></i>
                Quản Lý Sản Phẩm
            </h4>

            <div>
                <a href="{{ route('admin.product.index', ['status' => 'active']) }}"
                   class="btn btn-sm btn-outline-success me-2 {{ $status != 'trash' ? 'active' : '' }}">
                    Đang bán ({{ $count[0] }})
                </a>

                <a href="{{ route('admin.product.index', ['status' => 'trash']) }}"
                   class="btn btn-sm btn-outline-danger {{ $status == 'trash' ? 'active' : '' }}">
                    Thùng rác ({{ $count[1] }})
                </a>
            </div>

            <form method="GET" action="{{ route('admin.product.index') }}" class="d-flex">
                <input type="text"
                       name="keyword"
                       value="{{ $keyword ?? '' }}"
                       class="form-control form-control-sm"
                       placeholder="Tìm sản phẩm..."
                       style="width:220px;">
                <button class="btn btn-sm btn-primary ms-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        @foreach (['error' => 'danger', 'success' => 'success'] as $msg => $type)
            @if (session($msg))
                <div class="alert alert-{{ $type }} py-2 mb-2">
                    {{ session($msg) }}
                </div>
            @endif
        @endforeach

        @if($keyword && $products->total() == 0)
            <div class="alert alert-warning py-2 mb-3">
                Không tìm thấy kết quả cho: <strong>{{ $keyword }}</strong>
            </div>
        @endif
    </div>

    <div class="card shadow-sm flex-grow-1">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="table-light">
                        <tr>
                            <th style="width:5%">#</th>
                            <th style="width:12%">Loại</th>
                            <th style="width:13%">Tên</th>
                            <th style="width:20%">Mô tả</th>
                            <th style="width:10%">Giá</th>
                            <th style="width:10%">Ảnh</th>
                            <th style="width:10%">Trạng thái</th>
                            <th style="width:20%">Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse ($products as $index => $product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->category?->TYPE ?? 'Chưa phân loại' }}</td>
                            <td>{{ $product->NAME }}</td>
                            <td class="text-start" style="max-width:300px;">
                                {{ $product->DESCRIPTION }}
                            </td>
                            <td class="fw-bold text-success">
                                {{ number_format($product->PRICE) }} đ
                            </td>
                            <td>
                                <img src="{{ asset($product->IMG_URL) }}"
                                     class="rounded"
                                     style="width:55px;height:55px;object-fit:cover;">
                            </td>
                            <td>
                                @if($product->ACTIVE_FLAG)
                                    <span class="badge bg-success">Đang bán</span>
                                @else
                                    <span class="badge bg-secondary">Ngưng bán</span>
                                @endif
                            </td>
                            <td>
                                @if ($status !== 'trash')
                                    <a href="{{ route('admin.product.edit', $product->ID) }}"
                                       class="btn btn-sm btn-outline-primary me-1">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Sửa
                                    </a>

                                    <form action="{{ route('admin.product.destroy', $product->ID) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-warning">
                                            <i class="fa-solid fa-trash"></i>
                                            Xóa
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.product.restore', $product->ID) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-success">
                                            <i class="fa-solid fa-rotate-left"></i>
                                            Khôi phục
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-muted py-4">
                                Không có sản phẩm
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-auto pt-3">
        <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>

@endsection

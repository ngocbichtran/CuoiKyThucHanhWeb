@extends('layouts.admin')

@section('content')

<div class="container d-flex flex-column"
     style="padding-left: 30px; max-width: 1100px; min-height: calc(100vh - 120px);">

    <!-- FILTER -->
    <div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="page-title">Quản lý danh mục</h3>

            <div class="d-flex">
                <a href="{{ route('admin.category.index', ['status' => 'active']) }}"
                   class="btn btn-outline-primary me-2 {{ $status != 'trash' ? 'active' : '' }}">
                    Đang bày bán ({{ $count['active'] }})
                </a>

                <a href="{{ route('admin.category.index', ['status' => 'trash']) }}"
                   class="btn btn-outline-danger {{ $status == 'trash' ? 'active' : '' }}">
                    Thùng rác ({{ $count['trash'] }})
                </a>
            </div>
        </div>

        <!-- SEARCH + ALERT -->
        <div class="d-flex mb-3">
            <form method="GET" action="{{ route('admin.category.index') }}" class="d-flex">
                <input type="text"
                       name="keyword"
                       value="{{ $keyword ?? '' }}"
                       class="form-control"
                       placeholder="Tìm kiếm..."
                       style="width:230px;">
                <button class="btn btn-primary ms-2">Tìm</button>
            </form>

            <div class="ms-3">
                @if($keyword && $category->total() == 0)
                    <div class="alert alert-warning py-2 mb-2">
                        Không tìm thấy kết quả cho: <strong>{{ $keyword }}</strong>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success py-2 mb-2">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger py-2 mb-2">{{ session('error') }}</div>
                @endif
            </div>
        </div>
    </div>

    <!-- TABLE (CO GIÃN) -->
    <div class="card shadow-sm flex-grow-1">
        <div class="card-body p-0 d-flex flex-column">

            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle mb-0">
                    <thead class="table-light">
                        <tr class="fw-bold">
                            <th style="width:7%">STT</th>
                            <th style="width:18%">Tên loại</th>
                            <th style="width:30%">Mô tả</th>
                            <th style="width:15%">Trạng thái</th>
                            <th style="width:15%">Ngày tạo</th>
                            <th style="width:20%">Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($category as $index => $cate)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $cate->TYPE }}</td>
                            <td style="white-space: normal;">{{ $cate->DESCRIPTION }}</td>
                            <td>
                                @if($cate->ACTIVE_FLAG)
                                    <span class="badge bg-success">Đã bày bán</span>
                                @else
                                    <span class="badge bg-secondary">Chưa bày bán</span>
                                @endif
                            </td>
                            <td>
                                {{ $cate->CREATE_DATE
                                    ? \Carbon\Carbon::parse($cate->CREATE_DATE)->format('d/m/Y')
                                    : '-' }}
                            </td>
                            <td>
                                @if ($status !== 'trash')
                                    <a href="{{ route('admin.category.edit', $cate->ID) }}"
                                       class="btn btn-sm btn-outline-primary me-1">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Sửa
                                    </a>

                                    <form action="{{ route('admin.category.destroy', $cate->ID) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Vô hiệu hóa loại này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-warning">
                                            <i class="fa-solid fa-trash"></i>
                                            Xóa
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.category.restore', $cate->ID) }}"
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
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <!-- PAGINATION – LUÔN DÍNH ĐÁY -->
    <div class="mt-auto pt-3">
        <div class="d-flex justify-content-center">
            {{ $category->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>

@endsection

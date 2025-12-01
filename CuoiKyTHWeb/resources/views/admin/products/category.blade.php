@extends('layouts/admin')

@section('content')

<div class="container" style="padding-left: 30px; max-width: 1100px;">

    <!-- Bộ lọc trạng thái -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h3 class="page-title">Quản lý danh mục</h3>

        <div class="d-flex">
            <a href="{{ route('admin.category.index', ['status' => 'active']) }}"
                class="btn btn-outline-primary me-2 {{ $status != 'trash' ? 'active' : '' }}"
                style="margin-right:10px;">
                Đang bày bán ({{ $count['active'] }})
            </a>

            <a href="{{ route('admin.category.index', ['status' => 'trash']) }}"
                class="btn btn-outline-danger {{ $status == 'trash' ? 'active' : '' }}">
                Thùng rác ({{ $count['trash'] }})
            </a>
        </div>
    </div>
<div class="d-flex">
    <!-- Tìm kiếm -->
    <form method="GET" action="{{ route('admin.category.index') }}" class="d-flex mb-3">
        <input type="text" name="keyword" value="{{ $keyword ?? '' }}"
            class="form-control" placeholder="Tìm kiếm..." style="width:230px;">
        <button class="btn btn-primary ms-2" style="margin-right:10px;">Tìm</button>
    </form>

    <!-- Thông báo -->
    <div>
        @if($keyword && $category->total() == 0)
            <div class="alert alert-warning py-2 mb-2">
                Không tìm thấy kết quả cho từ khóa: <strong>{{ $keyword }}</strong>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success py-2 mb-2">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger py-2 mb-2">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger py-2 mb-2">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
    <!-- Form hành động hàng loạt -->
    <form action="{{ route('admin.category.action') }}" method="POST">
        @csrf

        <div class="d-flex mb-2">

            @if($status != 'trash')
                <button name="act" value="delete" class="btn btn-danger me-2">
                    Xóa tạm thời
                </button>
            @else
                <button name="act" value="restore" class="btn btn-success me-2">
                    Khôi phục
                </button>
            @endif

        </div>

        <!-- Bảng -->
        <div class="table-responsive d-flex justify-content-center mt-3">
            <table class="table table-bordered table-hover text-center align-middle mb-0"
                style="width: 100%; table-layout: fixed;">

                <thead>
                    <tr class="fw-bold text-dark">
                        <th style="width:5%;">
                            <input type="checkbox" id="checkall">
                        </th>
                        <th style="width:7%;">STT</th>
                        <th style="width:18%;">Tên loại</th>
                        <th style="width:30%;">Mô tả</th>
                        <th style="width:15%;">Trạng thái</th>
                        <th style="width:15%;">Ngày tạo</th>
                        <th style="width:20%;">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($category as $index => $cate)
                        <tr>

                            <td>
                                <input type="checkbox" name="list_check[]" value="{{ $cate->ID }}">
                            </td>

                            <td>{{ $index + 1 }}</td>

                            <td>{{ $cate->TYPE }}</td>

                            <td style="white-space: normal; word-break: break-word;">
                                {{ $cate->DESCRIPTION }}
                            </td>

                            <td>
                                @if($cate->ACTIVE_FLAG == 1)
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
                                @if($status != "trash")
                                    <a href="{{ route('admin.category.edit', $cate->ID) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                @endif

                                <form action="{{ route('admin.category.destroy', $cate->ID) }}"
                                    method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Chắc chắn muốn xóa?')"
                                        class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $category->links('pagination::bootstrap-5') }}
        </div>

    </form>

</div>

<script>
document.getElementById('checkall').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('input[name="list_check[]"]');
    checkboxes.forEach(el => el.checked = this.checked);
});
</script>

@endsection

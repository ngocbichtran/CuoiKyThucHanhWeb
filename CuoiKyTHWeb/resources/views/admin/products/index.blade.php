@extends('layouts/admin')

@section('content')
<div class="container" style="padding-left: 30px; max-width: 1100px;">

    <!-- Bộ lọc trạng thái -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h3 class="page-title">Quản lý sản phẩm</h3>

        <div class="d-flex">
            <a href="{{ route('admin.product.index', ['status' => 'active']) }}"
                class="btn btn-outline-primary me-2 {{ $status != 'trash' ? 'active' : '' }}">
                Sản phẩm đang bán ({{ $count[0] }})
            </a>

            <a href="{{ route('admin.product.index', ['status' => 'trash']) }}"
                class="btn btn-outline-danger {{ $status == 'trash' ? 'active' : '' }}">
                Thùng rác ({{ $count[1] }})
            </a>
        </div>
    </div>

    <!-- Bộ lọc tìm kiếm -->
    <form method="GET" action="{{ route('admin.product.index') }}" class="d-flex mb-3">
        <input type="text" name="keyword" value="{{ $keyword ?? '' }}"
            class="form-control" placeholder="Tìm kiếm sản phẩm..." style="width: 230px;">
        <button class="btn btn-primary ms-2">Tìm</button>
    </form>

    <!-- Hiển thị thông báo -->
    <div>
        @if($keyword && $products->total() == 0)
            <div class="alert alert-warning py-2">
                Không tìm thấy kết quả cho từ khóa: <strong>{{ $keyword }}</strong>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger py-2">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="alert alert-success py-2">{{ session('success') }}</div>
        @endif
    </div>

    <!-- Form hành động hàng loạt -->
    <form method="POST" action="{{ route('admin.product.action') }}">
        @csrf

        <div class="d-flex mb-2">

            @if($status != 'trash')
                <button name="act" value="delete" class="btn btn-danger me-2">
                    🗑 Xóa tạm thời
                </button>

            @else
                <button name="act" value="restore" class="btn btn-success me-2">
                    ♻ Khôi phục
                </button> 

            @endif

        </div>

        <!-- Bảng sản phẩm -->
        <table class="table table-bordered table-hover text-center align-middle">
            <thead>
                <tr class="text-dark fw-bold">
                    <th><input type="checkbox" id="checkall"></th>
                    <th>STT</th>
                    <th>ID Loại</th>
                    <th>Tên sản phẩm</th>
                    <th>Mô tả</th>
                    <th>Ảnh</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                @php $t = 0; @endphp
                @foreach ($products as $product)
                    @php $t++; @endphp
                    <tr>
                        <td>
                            <input type="checkbox" name="list_check[]" value="{{ $product->ID }}">
                        </td>

                        <td>{{ $t }}</td>
                        <td>{{ $product->CATE_ID }}</td>

                        <td>{{ $product->NAME }}</td>

                        <td class="text-truncate" style="max-width: 150px;">
                            {{ $product->DESCRIPTION }}
                        </td>

                        <td>
                            <img src="{{ asset($product->IMG_URL) }}"
                                alt="{{ $product->NAME }}"
                                style="width: 55px; height: 55px; border-radius:6px; object-fit:cover;">
                        </td>

                        <td>
                            @if($product->ACTIVE_FLAG == 1)
                                <span class="badge bg-success text-white">Đã bày bán</span>
                            @else
                                <span class="badge bg-secondary text-white">Chưa bày bán</span>
                            @endif
                        </td>

                        <td>
                            {{ $product->CREATE_DATE
                                ? \Carbon\Carbon::parse($product->CREATE_DATE)->format('d/m/Y')
                                : '-' }}
                        </td>

                        <td>
                            @if($status != "trash")
                                <a href="{{ route('admin.product.edit', $product->ID) }}"
                                    class="btn btn-sm btn-primary">✏️ Sửa</a>
                            @endif

                            <form method="POST"
                                action="{{ route('admin.product.destroy', $product->ID) }}"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Bạn có chắc muốn xóa?')">
                                    🗑 Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Phân trang -->
        <div class="d-flex justify-content-center mt-3">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </form>

</div>

<script>
// Check all
document.getElementById('checkall').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('input[name="list_check[]"]');
    checkboxes.forEach(c => c.checked = this.checked);
});
</script>

@endsection

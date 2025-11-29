@extends('layouts/admin')
@section('content')
<div style="display: flex; align-items: center; margin-bottom: 15px;">
    <!-- Thông báo -->
    <div style=" margin-left:50px;">
        @if(session('success'))
            <div class="alert alert-success" style="margin:0;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" style="margin:0;">
                {{ session('error') }}
            </div>
        @endif
    </div>

</div>

<form method="GET" action="{{ route('admin.category.index') }}" class="d-flex mb-3">
    <input type="text" name="keyword" value="{{ $keyword ?? '' }}" 
        class="form-control me-2" placeholder="Tìm kiếm...">
    <button class="btn btn-primary">Tìm</button>
</form>
@if($keyword && $users->total() == 0)
    <div class="alert alert-warning">
        Không tìm thấy kết quả nào cho từ khóa: <strong>{{ $keyword }}</strong>
    </div>
@endif

    <div class="container" style="margin-right:0px; ">
            <div class="table-responsive" style="display: flex; justify-content: center; margin-top:50px;">
               <table class="table table-bordered table-hover text-center align-middle mb-0"
                    style="width: 90%; table-layout: fixed; border:2px solid;">

                    <thead class="text-center">
                        <tr>
                            <th style="width: 6%;">STT</th>
                            <th style="width: 20%;">Tên loại</th>
                            <th style="width: 30%;">Mô tả</th>
                            <th style="width: 15%;">Trạng thái</th>
                            <th style="width: 15%;">Ngày tạo</th>
                            <th style="width: 20%;">Hành động</th>
                        </tr>
                    </thead>
                    <?php
                    $t=0;
                    ?>
                    <tbody>
                        @foreach ($categories as $category)
                        <?php
                        $t++;
                        ?>
                            <tr>

                                <td>{{ $t }}</td>

                                <td>{{ $category->TYPE }}</td>

                                <td style="white-space: normal; word-break: break-word;">
                                    {{ $category->DESCRIPTION }}
                                </td>

                                <td>
                                    @if($category->ACTIVE_FLAG == 1)
                                        <span class="badge bg-success">Đã bày bán</span>
                                    @else
                                        <span class="badge bg-secondary">Chưa bày bán</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $category->CREATE_DATE
                                        ? \Carbon\Carbon::parse($category->CREATE_DATE)->format('d/m/Y')
                                        : '-' }}
                                </td>

                                <td>
                                    <a href="{{ route('admin.category.edit', $category->ID) }}" 
                                    class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('admin.category.destroy', $category->ID) }}"
                                        method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc muốn xóa?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>

@endsection
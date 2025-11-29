@extends('layouts/admin')
@section('content')

    <div class="container" style="margin-right:0px;">
        <div class=" text-center rounded p-4">
            <!-- Tìm kiếm -->
            <form method="GET" action="{{ route('admin.product.index') }}" class="d-flex mb-3">
                <input type="text" name="keyword" value="{{ $keyword ?? '' }}" 
                    class="form-control me-2" placeholder="Tìm kiếm...">
                <button class="btn btn-primary">Tìm</button>
            </form>
            @if($keyword && $product->total() == 0)
                    <div class="alert alert-warning">
                        Không tìm thấy kết quả nào cho từ khóa: <strong>{{ $keyword }}</strong>
                    </div>
            @endif

            <!-- Form dữ liệu -->
        <div class="table-responsive" style="display: flex; justify-content: center; margin-top:50px;">
            <table class="table table-bordered table-hover text-center align-middle mb-0" style="width: 100%; margin: 0; table-layout: fixed;border-collapse: collapse;border-color:black;">
                    <thead style="text-align: center;">
                    <tr class="text-white">
                        <th scope="col" style="width: 6%; text-align:center;">STT</th>
                        <th scope="col" style="width: 10%; text-align:center;">ID Loại</th>
                        <th scope="col" style="width: 20%;">Tên sản phẩm</th>
                        <th scope="col" style="width: 18%;">Mô tả</th>
                        <th scope="col" style="width: 18%;">Ảnh sản phẩm</th>
                        <th scope="col" style="width: 15%; text-align:center;">Trạng thái</th>
                        <th scope="col" style="width: 12%; text-align:center;">Ngày tạo</th>
                        <th scope="col" style="width: 18%; text-align:center;">Hành động</th>

                    </tr>

                    </thead>
                     <?php
                    $t=0;
                    ?>
                     <tbody>
                       <tbody>
                            @foreach ($product as $product)
                                <?php
                                $t++;
                                ?>
                                <tr>
                                    <td>{{ $t }}</td>
                                    <td>{{ $product->CATE_ID }}</td>
                                    <td>{{ $product->NAME }}</td>
                                    <td>{{ $product->DESCRIPTION }}</td>
                                    <td>
                                        <img src="{{ asset($product->IMG_URL) }}" alt="{{ $product->NAME }}" width="80">
                                    </td>
                                    <td>
                                        @if($product->ACTIVE_FLAG == 1)
                                            <span class="badge bg-success">Đã bày bán</span>
                                        @else
                                            <span class="badge bg-secondary">Chưa bày bán</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->CREATE_DATE ? \Carbon\Carbon::parse($product->CREATE_DATE)->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.product.edit', $product->ID) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('admin.product.destroy', $product->ID) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Delete</button>
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
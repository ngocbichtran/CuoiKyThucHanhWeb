@extends('layouts/admin')

@section('content')
<div class="container" style="margin-left: 305px; padding-top: 120px;">
    <form action="{{ route('admin.product.store') }}" method="POST" class="form-inline"
          style="max-width: 400px; margin-left: 200px;">
          
        @csrf

        <div class="form-group mb-3 d-flex align-items-center">
            <label for="id" style="width: 80px;">ID</label>
            <input type="text" id="id" name="ID" class="form-control" style="flex: 1;">
        </div>

        <div class="form-group mb-3 d-flex align-items-center">
            <label for="cate" style="width: 80px;">Loại</label>

            <select id="cate" name="CATE_ID" class="form-control" style="flex: 1;">
                <option value="">--Chọn loại--</option>

                @foreach ($categoryList as $cate)
                    <option value="{{ $cate->ID }}">{{ $cate->TYPE }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3 d-flex align-items-center">
            <label for="name" style="width: 80px;">Name</label>
            <input type="text" id="name" name="NAME" class="form-control" style="flex: 1;">
        </div>

        <div class="form-group mb-3 d-flex align-items-center">
            <label for="desc" style="width: 80px;">Mô tả</label>
            <textarea id="desc" name="DESCRIPTION" class="form-control" style="flex: 1;"></textarea>
        </div>

        <div class="form-group mb-3 d-flex align-items-center">
            <label for="img" style="width: 80px;">IMG URL</label>
            <input type="text" id="img" name="IMG_URL" class="form-control" style="flex: 1;">
        </div>

        <div class="form-group mb-3 d-flex align-items-center">
            <label for="flag" style="width: 80px;">Trạng thái</label>
            <select id="flag" name="ACTIVE_FLAG" class="form-control" style="flex: 1;">
                <option value="1">Đã bày bán</option>
                <option value="0">Chưa bày bán</option>
            </select>
        </div>

        <div class="text-start">
            <button type="submit" class="btn btn-success">Save</button>
        </div>

    </form>
</div>
@endsection

@extends('layouts/admin')

@section('content')
<div class="container">
    <form action="{{ route('admin.product.store') }}" method="POST"
          style="display: flex; flex-direction: column; max-width:400px; margin: 0 auto;">
          
        @csrf

        <div class="form-group mb-3">
            <label for="id">ID</label>
            <input type="text" id="id" name="ID" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="cate">Loại</label>

            <select id="cate" name="CATE_ID" class="form-control">
                <option value="">--Chọn loại--</option>

                @foreach ($categoryList as $cate)
                    <option value="{{ $cate->ID }}">{{ $cate->TYPE }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" id="name" name="NAME" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="desc">Mô tả</label>
            <textarea id="desc" name="DESCRIPTION" class="form-control"></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="img">IMG URL</label>
            <input type="text" id="img" name="IMG_URL" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="flag" >Trạng thái</label>
            <select id="flag" name="ACTIVE_FLAG" class="form-control">
                <option value="1">Đã bày bán</option>
                <option value="0">Chưa bày bán</option>
            </select>
        </div>

           <div style="display: flex; justify-content: center; width: 100%;">
    <button type="submit" class="btn btn-success" style="width:200px;">Save</button>
    </div>

    </form>
</div>
@endsection

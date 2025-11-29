@extends('layouts/admin')

@section('content')
<div class="container" style="margin-left: 305px; padding-top: 120px;">
    <form action="{{ route('admin.category.store') }}" method="POST" class="form-inline"
          style="max-width: 400px; margin-left: 200px;">
        @csrf

        <div class="form-group mb-3">
            <label for="type">ID</label>
            <input type="text" id="type" name="TYPE" class="form-control">
        </div>
          <div class="form-group mb-3">
            <label for="type">Tên Loại</label>
            <input type="text" id="type" name="TYPE" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="desc">Mô tả</label>
            <textarea id="desc" name="DESCRIPTION" class="form-control"></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="flag">Trạng thái</label>
            <select id="flag" name="ACTIVE_FLAG" class="form-control">
                <option value="1">Đã bày bán</option>
                <option value="0">Chưa bày bán</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save</button>

    </form>
</div>

@endsection

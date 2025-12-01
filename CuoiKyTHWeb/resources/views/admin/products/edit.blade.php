@extends('layouts/admin')

@section('content')
<div class="container" style= padding-top: 120px;">

    <form 
        action="{{ route('admin.product.update', $product->ID) }}" 
        method="POST"
        style=" margin:auto; width:300px;"
    >
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group mb-3">
            <label>ID</label>
            <input type="text" name="ID" class="form-control" 
                value="{{ $product->ID }}" readonly>
        </div>

        <div class="form-group mb-3">
            <label>Loại</label>
            <select name="CATE_ID" class="form-control">
                <option value="">--Chọn loại--</option>

                @foreach ($categories as $cate)
                    <option 
                        value="{{ $cate->ID }}" 
                        {{ old('CATE_ID', $product->CATE_ID) == $cate->ID ? 'selected' : '' }}>
                        {{ $cate->TYPE }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Name</label>
            <input type="text" name="NAME" class="form-control"
                value="{{ old('NAME', $product->NAME) }}">
        </div>

        <div class="form-group mb-3">
            <label>Mô tả</label>
            <textarea name="DESCRIPTION" class="form-control">{{ old('DESCRIPTION', $product->DESCRIPTION) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label>IMG URL</label>
            <input type="text" name="IMG_URL" class="form-control"
                value="{{ old('IMG_URL', $product->IMG_URL) }}">
        </div>

        <div class="form-group mb-3">
            <label>Trạng thái</label>
            <select name="ACTIVE_FLAG" class="form-control">
                <option value="1" {{ old('ACTIVE_FLAG', $product->ACTIVE_FLAG) == 1 ? 'selected' : '' }}>Đã bày bán</option>
                <option value="0" {{ old('ACTIVE_FLAG', $product->ACTIVE_FLAG) == 0 ? 'selected' : '' }}>Chưa bày bán</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>

    </form>

</div>
@endsection

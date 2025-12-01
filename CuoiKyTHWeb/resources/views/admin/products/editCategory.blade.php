@extends('layouts/admin')

@section('content')
<div class="container" style="margin-left: 305px; padding-top: 120px;">

    <form 
        action="{{ route('admin.category.update', $category->ID) }}" 
        method="POST"
        class="form-inline"
        style="max-width: 400px; margin-left: 200px;"
    >
        @csrf
        @method('PUT')

        {{-- ID ẩn --}}
        <input type="hidden" name="ID" value="{{ $category->ID }}">

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ID (chỉ hiển thị) --}}
        <div class="form-group mb-3">
            <label>ID</label>
            <input type="text" class="form-control" value="{{ $category->ID }}" readonly>
        </div>

        {{-- TYPE --}}
        <div class="form-group mb-3">
            <label for="type">Loại</label>
            <input 
                type="text" 
                id="type" 
                name="TYPE" 
                class="form-control"
                value="{{ old('TYPE', $category->TYPE) }}"
            >
        </div>

        {{-- DESCRIPTION --}}
        <div class="form-group mb-3">
            <label for="desc">Mô tả</label>
            <textarea 
                id="desc" 
                name="DESCRIPTION" 
                class="form-control"
            >{{ old('DESCRIPTION', $category->DESCRIPTION) }}</textarea>
        </div>

        {{-- ACTIVE_FLAG --}}
        <div class="form-group mb-3">
            <label for="flag">Trạng thái</label>
            <select id="flag" name="ACTIVE_FLAG" class="form-control">
                <option value="1" {{ old('ACTIVE_FLAG', $category->ACTIVE_FLAG) == 1 ? 'selected' : '' }}>Đã bày bán</option>
                <option value="0" {{ old('ACTIVE_FLAG', $category->ACTIVE_FLAG) == 0 ? 'selected' : '' }}>Chưa bày bán</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>

    </form>
</div>
@endsection

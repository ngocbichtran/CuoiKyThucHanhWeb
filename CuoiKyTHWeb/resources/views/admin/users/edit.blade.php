@extends('layouts.admin')

@section('content')
<div class="container" style="margin-left: 305px; padding-top: 120px;">

    <form 
        action="{{ route('admin.users.update', $user->id) }}" 
        method="POST"
        class="form-inline"
        style="max-width: 450px; margin-left: 200px;"
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
    <input type="text" class="form-control" value="{{ $user->id }}" readonly>
</div>

<div class="form-group mb-3">
    <label>Name</label>
    <input 
        type="text" 
        name="name" 
        class="form-control"
        value="{{ old('name', $user->name) }}"
    >
</div>

<div class="form-group mb-3">
    <label>Email</label>
    <input 
        type="text" 
        name="email" 
        class="form-control"
        value="{{ old('email', $user->email) }}"
    >
</div>

<div class="form-group mb-3">
    <label>Mật khẩu mới (nếu muốn đổi)</label>
    <input 
        type="password" 
        name="password" 
        class="form-control"
        placeholder="Để trống nếu không đổi mật khẩu"
    >
</div>


        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>

</div>
@endsection

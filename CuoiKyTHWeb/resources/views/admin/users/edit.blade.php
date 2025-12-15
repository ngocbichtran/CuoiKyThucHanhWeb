@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0" style="max-width: 500px; margin: 0 auto;">

        <!-- HEADER -->
        <div class="card-header border-0">
            <h5 class="fw-bold mb-0">Cập nhật người dùng</h5>
         
        </div>

        <!-- BODY -->
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- HIỂN THỊ LỖI --}}
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label fw-semibold">ID</label>
                    <input type="text"
                           class="form-control bg-light"
                           value="{{ $user->id }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">User Name</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $user->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $user->email) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Mật khẩu mới <span class="text-muted">(nếu muốn đổi)</span>
                    </label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Để trống nếu không đổi mật khẩu">
                </div>

                <!-- ACTION -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                        Quay lại
                    </a>

                    <button type="submit" class="btn btn-success px-4">
                        Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

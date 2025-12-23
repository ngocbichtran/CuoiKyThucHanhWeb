@extends('layouts.admin')

@section('content')
<div class="container py-3">
    <div class="card shadow-sm border-0" style="max-width: 500px; margin: 0 auto;">

        <div class="card-header border-0">
            <h5 class="fw-bold mb-0">➕ Thêm người dùng</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">User Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Quyền hạn</label>
                    <select name="role" class="form-control">
                        <option value="user" selected>User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-5">
                        Lưu người dùng
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

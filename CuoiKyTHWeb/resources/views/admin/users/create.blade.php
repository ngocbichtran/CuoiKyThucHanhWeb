@extends('layouts.admin')

@section('content')
<div class="container py-3">
    <div class="card shadow-sm border-0" style="max-width: 500px; margin: 0 auto;">

        <!-- HEADER -->
        <div class="card-header bg-white border-0">
            <h5 class="fw-bold mb-0">➕ Thêm người dùng</h5>
        </div>

        <!-- BODY -->
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">User Name</label>
                    <input type="text"
                           name="USER_NAME"
                           class="form-control"
                          >
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password"
                           name="PASSWORD"
                           class="form-control"
                           >
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email"
                           name="EMAIL"
                           class="form-control"
                           >
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Quyền hạn</label>
                    <select name="ACTIVE_FLAG" class="form-control">
                        <option value="1">Admin</option>
                        <option value="0">Người dùng thường</option>
                    </select>
                </div>

                <!-- BUTTON -->
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

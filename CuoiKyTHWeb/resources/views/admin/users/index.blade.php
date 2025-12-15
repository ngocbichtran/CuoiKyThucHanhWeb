@extends('layouts/admin')

@section('content')

<div class="container-fluid px-4 py-4 d-flex flex-column"
     style="min-height: calc(100vh - 100px);">

    {{-- HEADER --}}
    <div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-primary mb-0">
                <i class="fa-solid fa-users me-2"></i>
                Quản Lý Người Dùng
            </h4>

            <div>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}"
                   class="btn btn-sm btn-outline-success me-2 {{ $status !== 'trash' ? 'active' : '' }}">
                    <i class="fa-solid fa-user-check me-1"></i>
                    Kích hoạt ({{ $count[0] }})
                </a>

                <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}"
                   class="btn btn-sm btn-outline-danger {{ $status === 'trash' ? 'active' : '' }}">
                    <i class="fa-solid fa-user-slash me-1"></i>
                    Vô hiệu hóa ({{ $count[1] }})
                </a>
            </div>

            {{-- SEARCH --}}
            <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex">
                <input type="text"
                       name="keyword"
                       value="{{ $keyword ?? '' }}"
                       class="form-control form-control-sm"
                       placeholder="Tìm kiếm..."
                       style="width:220px;">
                <button class="btn btn-sm btn-primary ms-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        {{-- ALERT --}}
        @foreach (['error' => 'danger', 'success' => 'success'] as $msg => $type)
            @if (session($msg))
                <div class="alert alert-{{ $type }} py-2 mb-3">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    {{ session($msg) }}
                </div>
            @endif
        @endforeach
    </div>

    {{-- TABLE (CO GIÃN) --}}
    <div class="card shadow-sm flex-grow-1">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th>Tên đăng nhập</th>
                            <th>Email</th>
                            <th width="15%">Quyền</th>
                            <th width="25%" class="text-center">Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>

                            <td class="fw-semibold">
                                <i class="fa-solid fa-user me-1 text-muted"></i>
                                {{ $user->name }}
                            </td>

                            <td>
                                <i class="fa-solid fa-envelope me-1 text-muted"></i>
                                {{ $user->email }}
                            </td>

                            <td>
                                <span class="badge {{ $user->role ? 'bg-info' : 'bg-secondary' }}">
                                    <i class="fa-solid fa-shield-halved me-1"></i>
                                    {{ $user->role ? 'Admin' : 'Quyền thường' }}
                                </span>
                            </td>

                            <td class="text-center">
                                @if ($status !== 'trash')
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="btn btn-sm btn-outline-primary me-1">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Sửa
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Vô hiệu hóa user này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-warning">
                                            <i class="fa-solid fa-user-slash"></i>
                                            Vô hiệu hóa
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.restore', $user->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Khôi phục user này?')">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-success">
                                            <i class="fa-solid fa-rotate-left"></i>
                                            Khôi phục
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="fa-solid fa-inbox me-1"></i>
                                Không có dữ liệu
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- PAGINATION – LUÔN DÍNH ĐÁY --}}
    <div class="mt-auto pt-3">
        <div class="d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>

@endsection

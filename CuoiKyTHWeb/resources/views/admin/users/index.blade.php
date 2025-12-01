@extends('layouts/admin')

@section('content')

<div class="container" style="max-width: 1200px; padding-top: 20px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary m-0" style="font-weight:600;">
            Quản Lý Người Dùng
        </h3>

        <div class="analytic">
            <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="text-success">
                Kích hoạt <span>({{ $count[0] }})</span>
            </a>

            <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-danger">
                Vô hiệu hóa <span>({{ $count[1] }})</span>
            </a>
        </div>

        <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex">
            <input type="text" name="keyword" value="{{ $keyword ?? '' }}" 
                class="form-control" placeholder="🔍 Tìm kiếm..." style="width:220px;">
            <button class="btn btn-primary ms-2">Tìm</button>
        </form>
    </div>

    


   <form action="{{ route('admin.users.action') }}" method="POST">
        @csrf 
<div class="d-flex">
      <div class="mb-3 gap-2">
            @if (request()->status == 'active' || !request()->status)
                <button type="submit" name="act" value="delete" class="btn btn-danger"  style="margin-right:10px;">
                     Vô hiệu hóa
                </button>
            @endif

            @if (request()->status == 'trash')
                <button type="submit" name="act" value="restore" class="btn btn-success"  style="margin-right:10px;">
                     Khôi phục
                </button>
            @endif
        </div>

        <div class="mb-3">
            @if($keyword && $users->total() == 0)
                <div class="alert alert-warning">
                    Không tìm thấy kết quả cho từ khóa: 
                    <strong>{{ $keyword }}</strong>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
</div>
        <div class="table-wrapper"  style="min-height:450px;">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="5%">
                            <input type="checkbox" name="checkall" id="checkall">
                        </th>
                        <th width="7%">STT</th>
                        <th width="20%">Tên Đăng Nhập</th>
                        <th width="25%">Email</th>
                        <th width="15%">Quyền Hạn</th>
                        <th width="20%">Hành Động</th>
                    </tr>
                </thead>

                <tbody>
                    @php $t = 0; @endphp
                    @foreach ($users as $user)
                        @php $t++; @endphp
                        <tr>
                            <td>
                                <input type="checkbox" name="list_check[]" value="{{ $user->id }}">
                            </td>

                            <td>{{ $t }}</td>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>

                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $user->role == false ? 'Quyền bình thường' : 'User' }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                    class="btn btn-sm btn-primary btn-action">
                                     Sửa
                                </a>

                                <form action="{{ route('admin.users.destroy', $user->id) }}" 
                                    method="POST" 
                                    style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-sm btn-danger btn-action"
                                            onclick="return confirm('Bạn có chắc muốn vô hiệu hóa?')">
                                         Vô hiệu hóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </form>

    
    <div class="d-flex justify-content-center mt-3">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>

</div>
<script>
document.getElementById('checkall').onclick = function() {
    const checkboxes = document.querySelectorAll('input[name="list_check[]"]');
    checkboxes.forEach(cb => cb.checked = this.checked);
};
</script>

@endsection

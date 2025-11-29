@extends('layouts/admin')

@section('content')


<div class="container">
    <div class="text-center rounded">
        <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex">
            <input type="text" name="keyword" value="{{ $keyword ?? '' }}" 
                class="form-control" placeholder="Tìm kiếm...">
            <button class="btn btn-primary">Tìm</button>
        </form>
        @if($keyword && $users->total() == 0)
            <div class="alert alert-warning">
                Không tìm thấy kết quả nào cho từ khóa: <strong>{{ $keyword }}</strong>
            </div>
        @endif


        <div >

            <!-- Khung cố định chiều cao của bảng -->
            <div style="min-height: 350px; width: 90%; margin-left: 5%; margin-top:15px;">
                <table class="table table-bordered table-hover text-center align-middle mb-0" 
                       style="table-layout: fixed;">

                    <thead>
                        <tr>
                            <th scope="col" style="width: 10%;">STT</th>
                            <th scope="col" style="width: 25%;">Tên Đăng Nhập</th>
                            <th scope="col" style="width: 30%;">Email</th>
                            <th scope="col" style="width: 20%;">Quyền Hạn</th>
                            <th scope="col" style="width: 20%;">Hành Động</th>
                        </tr>
                    </thead>
                    <?php
                    $t=0;
                    ?>
                    <tbody>
                        @foreach ($users as $user)
                         <?php
                    $t++;
                    ?>
                        <tr>
                            <td>{{ $t}}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role == false ? 'Quyền bình thường' : 'User' }}</td>

                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc muốn xóa?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <!-- PHÂN TRANG — luôn nằm dưới -->
            <div class="d-flex justify-content-center mt-4 ">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
            <!-- <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
            </nav> -->
        </div>
    </div>
</div>
@endsection

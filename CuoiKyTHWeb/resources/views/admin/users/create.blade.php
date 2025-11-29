@extends('layouts/admin')

@section('content')
<div class="container" style="margin-left: 305px; padding-top: 120px;">
    <form action="{{ route('admin.users.store') }}" method="POST" class="form-inline"
          style="max-width: 400px; margin-left: 200px;">
          
        @csrf

        <div class="form-group mb-3 d-flex align-items-center">
            <label for="name" style="width: 80px;">User Name</label>
            <input type="text" id="username" name="USER_NAME" class="form-control" style="flex: 1;">
        </div>

        <div class="form-group mb-3 d-flex align-items-center">
            <label for="name" style="width: 80px;">Password</label>
            <input type="password" id="password" name="PASSWORD" class="form-control" style="flex: 1;">
        </div>
                <div class="form-group mb-3 d-flex align-items-center">
            <label for="name" style="width: 80px;">Email</label>
            <input type="email" id="email" name="EMAIL" class="form-control" style="flex: 1;">
        </div>

        <div class="form-group mb-3 d-flex align-items-center">
            <label for="flag" style="width: 80px;">Quyền Hạn</label>
            <select id="flag" name="ACTIVE_FLAG" class="form-control" style="flex: 1;">
                <option value="1">Admin</option>
                <option value="0">Thường</option>
            </select>
        </div>

        <div class="text-start">
            <button type="submit" class="btn btn-success">Save</button>
        </div>

    </form>
</div>
@endsection

@extends('layouts/admin')

@section('content')
<div class="container">
    <form action="{{ route('admin.users.store') }}" method="POST"
         style="display: flex; flex-direction: column; max-width:400px;  margin: 0 auto;">
          
        @csrf

        <div class="form-group mb-3">
            <label for="name">User Name</label>
            <input type="text" id="username" name="USER_NAME" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="name">Password</label>
            <input type="password" id="password" name="PASSWORD" class="form-control">
        </div>
                <div class="form-group mb-3">
            <label for="name">Email</label>
            <input type="email" id="email" name="EMAIL" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="flag">Quyền Hạn</label>
            <select id="flag" name="ACTIVE_FLAG" class="form-control">
                <option value="1">Admin</option>
                <option value="0">Thường</option>
            </select>
        </div>

           <div style="display: flex; justify-content: center; width: 100%;">
    <button type="submit" class="btn btn-success" style="width:200px;">Save</button>
    </div>

    </form>
</div>
@endsection

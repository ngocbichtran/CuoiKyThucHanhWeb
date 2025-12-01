<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">

    <link rel="stylesheet" href="{{asset('assetAdmin/css/style.css')}}">

    <title>Administrator</title>

   
</head>

<body>
    <div id="warpper" class="nav-fixed">

        <nav class="topnav shadow d-flex justify-content-between align-items-center px-3">

            <div class="d-flex align-items-center">
                <div class="navbar-brand mb-0 mr-3">
                    <a href="?" class="font-weight-bold" style="font-size: 20px;">CAPYSHOP</a>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" title="Thêm mới">
                        <i class="fas fa-plus-circle"></i> Tạo mới
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('admin.category.create')}}">Thêm danh mục</a>
                        <a class="dropdown-item" href="{{route('admin.product.create')}}">Thêm sản phẩm</a>
                        <a class="dropdown-item" href="{{route('admin.users.create')}}">Thêm tài khoản</a>
                    </div>
                </div>
            </div>


            <div class="d-flex align-items-center">
                <div class="btn-group ml-3">
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-user-circle mr-1"></i> ok
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i> Tài khoản</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
                        </a>
                    </div>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>

        </nav>
        <div class="d-flex">

            <div id="sidebar">
                <ul id="sidebar-menu">

                    <li class="pc-item">
                        <a href="{{ route('dashboard') }}"
                        class="pc-link {{ Route::is('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            Trang chủ
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('admin.category.index') }}"
                        class="pc-link {{ Route::is('admin.category.*') ? 'active' : '' }}">
                            <i class="fas fa-tags"></i> Danh sách loại
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('admin.product.index') }}"
                        class="pc-link {{ Route::is('admin.product.*') ? 'active' : '' }}">
                            <i class="fas fa-box"></i> Danh sách sản phẩm
                        </a>
                    </li>

                    <li class="pc-item">
                        <a class="pc-link {{ Route::is('admin.orders.*') ? 'active' : '' }}" href="{{route('admin.orders.index')}}">
                            <i class="fas fa-shopping-cart"></i> Đơn hàng
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('admin.users.index') }}"
                        class="pc-link {{ Route::is('admin.users.*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i> Danh sách tài khoản
                        </a>
                    </li>

                </ul>
            </div>

            <div class="flex-fill">
                @yield('content')
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{asset('assetAdmin/js/app.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    document.documentElement.setAttribute(
        "data-theme",
        localStorage.getItem("theme") ?? "light"
    );
</script>
</body>

</html>
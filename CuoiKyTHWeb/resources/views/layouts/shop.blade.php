<!DOCTYPE html>
<html class="light" lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CapyElectroShop</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script>
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            primary: "#135bec",
            "background-light": "#f6f6f8",
            "background-dark": "#101622",
          },
          fontFamily: {
            display: ["Inter", "sans-serif"],
          },
          borderRadius: {
            DEFAULT: "0.25rem",
            lg: "0.5rem",
            xl: "0.75rem",
            full: "9999px",
          },
        },
      },
    };
  </script>

  <style>
    body { font-family: 'Inter', sans-serif; }
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
  </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#0d121b] dark:text-[#e0e0e0]">

<header class="sticky top-0 z-50 border-b border-[#e7ebf3]
               bg-white/90 backdrop-blur-md
               dark:border-gray-800 dark:bg-gray-900/90">
    <div class="mx-auto flex h-16 max-w-[1200px]
                items-center justify-between px-4 sm:px-6 lg:px-8">

        <a href="{{ route('shop') }}" class="flex items-center gap-2">
            <div class="flex size-8 items-center justify-center
                        rounded-lg bg-primary text-white">
                <span class="material-symbols-outlined">bolt</span>
            </div>
            <h1 class="text-xl font-bold dark:text-white">
                CapyShop
            </h1>
        </a>

        <div class="flex items-center gap-4">

            @auth
            <div class="flex items-center gap-2 px-3 py-1
                        rounded-full bg-gray-100 dark:bg-gray-800">
                <span class="material-symbols-outlined text-gray-500 text-[22px]">
                    account_circle
                </span>
                <span class="text-sm font-medium truncate max-w-[120px]">
                    {{ Str::words(Auth::user()->name, 2, '') }}
                </span>
            </div>

            <a href="{{ route('shop') }}"
              class="flex items-center gap-1 px-4 py-2
                      rounded-lg bg-yellow-100 text-yellow-700
                      hover:bg-yellow-200 transition">
                <span class="material-symbols-outlined text-[20px]">
                    home
                </span>
                Trang chủ
            </a>

            <a href="{{ route('cart') }}"
               class="flex items-center gap-1 px-4 py-2
                      rounded-lg bg-blue-50 text-primary hover:bg-blue-100">
                <span class="material-symbols-outlined">shopping_cart</span>
                Đơn hàng
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center gap-1 px-4 py-2
                           rounded-lg bg-red-50 text-red-600 hover:bg-red-100">
                    <span class="material-symbols-outlined">logout</span>
                    Đăng xuất
                </button>
            </form>
            @endauth

            @guest
            <a href="{{ route('login') }}"
               class="px-4 py-2 rounded-lg bg-primary text-white">
                Đăng nhập
            </a>
            @endguest

        </div>
    </div>
</header>

<!-- Main -->
<main>
@yield('content')
</main>

<!-- Footer -->
<footer class="border-t border-[#e7ebf3] bg-white py-12 dark:border-gray-800 dark:bg-gray-900">
  <div class="mx-auto max-w-[1200px] px-4 text-center">
    <div class="mb-4 flex justify-center items-center gap-2">
      <div class="flex size-8 items-center justify-center rounded-lg bg-primary text-white">
        <span class="material-symbols-outlined">bolt</span>
      </div>
      <span class="text-xl font-bold dark:text-white">ElectroShop</span>
    </div>
    <p class="mt-8 text-sm text-gray-500">© DH52200637_Nguyễn Trí Hào - DH52200383_Trần Ngọc Bích.</p>
  </div>
</footer>

</body>
</html>
@extends('layouts.shop')

@section('content')

<!--Thông báo đặt hàng thành công-->

<section class="bg-white py-12 dark:bg-background-dark/50">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">

        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <h2 class="text-2xl font-bold dark:text-white">
              Sản phẩm bán chạy
            </h2>

            @if (session('success'))
            <div class="flex items-center gap-2 rounded-lg
                                bg-green-50 border border-green-200
                                px-4 py-2 text-green-700">
                        <span class="material-symbols-outlined text-green-600 text-[20px]">
                            check_circle
                        </span>
                        <span class="text-sm font-medium whitespace-nowrap">
                            {{ session('success') }}
                        </span>
                    </div>
             @endif
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($products as $product)
            <article
                class="group relative flex flex-col overflow-hidden rounded-2xl
                       border border-gray-100 bg-white shadow-sm
                       transition-all duration-300 hover:-translate-y-1 hover:shadow-lg
                       dark:border-gray-800 dark:bg-gray-900">

                <div class="aspect-square bg-gray-100 p-4">
                    <img
                        src="{{ asset($product->IMG_URL) }}"
                        alt="{{ $product->NAME }}"
                        class="h-full w-full object-contain transition group-hover:scale-105">
                </div>

                <div class="flex flex-1 flex-col p-4">
                    <h3 class="mb-2 line-clamp-2 font-semibold dark:text-white">
                        {{ $product->NAME }}
                    </h3>

                    <div class="mt-auto flex items-center justify-between">
                        <span class="text-lg font-bold text-primary">
                            {{ number_format($product->PRICE) }} đ
                        </span>

                        <!--  Add to cart  -->
                        <form action="{{ route('shop.order') }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->ID }}">
                            <input type="hidden" name="don_gia" value="{{ $product->PRICE }}">

                            <input type="number" name="so_luong"
                                   value="1" min="1"
                                   class="w-16 rounded-md border-gray-300 text-center
                                          focus:border-primary focus:ring-primary">

                            <button type="submit"
                                class="flex size-9 items-center justify-center rounded-full
                                       bg-blue-50 text-primary transition
                                       hover:bg-primary hover:text-white
                                       dark:bg-gray-800">
                                <span class="material-symbols-outlined text-[20px]">
                                    add_shopping_cart
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $products->links() }}
        </div>

    </div>
</section>

@endsection

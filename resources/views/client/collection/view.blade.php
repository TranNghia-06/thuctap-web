@extends('layouts.app')

@section('title')
    {{ __('Danh sách bộ sưu tập') }}
@endsection

@php
    $searching = request()->get('q') ?? '';
@endphp

@section('content')
    <div class="px-2">
        <x-ui.breadcrumb :is-admin="0" is-dark :breadcrumbs="[['url' => 'client.collection', 'label' => 'Bộ sưu tập']]" />

        <h1 class="mt-7 text-5xl text-white text-center capitalize">
        List of collections
        </h1>

        <!-- Thanh tìm kiếm -->
        <form class="mt-20 max-w-md mx-auto" action="{{ route('client.collection') }}" method="GET">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Tìm</label>

            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" name="q" value="{{ $searching }}"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Tìm kiếm bài viết..." required />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    {{ __('Tìm kiếm') }}
                </button>
            </div>
        </form>

        @php
    $half = ceil($data->count() / 2);
    $highlight = $data->take($half);
    $best = $data->slice($half);
@endphp

<!-- Collection Highlight -->
<h2 class="text-white text-4xl font-semibold mb-12 mt-16">Collection Highlights</h2>

<div class="relative">
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 overflow-hidden" id="highlight-carousel">
        @foreach ($highlight as $item)
            <div class="carousel-item mt-6 bg-transparent rounded-lg shadow-md overflow-hidden
                        transition transform hover:scale-105 hover:shadow-xl">
                <a href="{{ route('client.collection.details', $item->id) }}">
                    <img class="h-[330px] w-full object-cover"
                         src="{{ asset('storage/' . $item->thumbnail) }}"
                         alt="{{ $item->name }}" />
                </a>

                <div class="p-5">
                    <a href="{{ route('client.collection.details', $item->id) }}">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white truncate">
                            {{ $item->name }}
                        </h5>
                    </a>

                    <!-- <p class="mb-3 text-gray-300 line-clamp-1">
                        {{ $item->description }}
                    </p> -->

                    <div class="flex flex-wrap gap-2 mt-3">
                        @if($item->is_sale)
                            <a href="{{ route('cart.add', $item->id) }}"
                               class="text-sm font-medium text-white bg-green-600 px-3 py-2 rounded
                                      transition hover:bg-green-700">
                                Thêm giỏ hàng
                            </a>
                        @endif

                        <!-- <a href="{{ route('client.collection.details', $item->id) }}"
                           class="text-sm font-medium text-white bg-blue-600 px-3 py-2 rounded
                                  transition hover:bg-blue-700">
                            Xem chi tiết
                        </a> -->
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Nút chuyển động qua lại -->
    <button id="prev-btn" class="absolute top-1/2 left-0 transform -translate-y-1/2 text-white bg-gray-800 hover:bg-gray-600 p-2 rounded-r-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button id="next-btn" class="absolute top-1/2 right-0 transform -translate-y-1/2 text-white bg-gray-800 hover:bg-gray-600 p-2 rounded-l-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</div>

<!-- Thêm JavaScript cho hiệu ứng chuyển động -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('highlight-carousel');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const itemsPerPage = 4; // Số lượng item hiển thị mỗi lần
        let currentIndex = 0;

        // Hiển thị các item theo nhóm
        function showItems() {
            const items = carousel.querySelectorAll('.carousel-item');
            items.forEach((item, index) => {
                item.style.display = (index >= currentIndex && index < currentIndex + itemsPerPage) ? 'block' : 'none';
            });
        }

        // Next Button - chuyển qua phải
        nextBtn.addEventListener('click', () => {
            if (currentIndex + itemsPerPage < carousel.querySelectorAll('.carousel-item').length) {
                currentIndex += itemsPerPage;
            }
            showItems();
        });

        // Prev Button - chuyển qua trái
        prevBtn.addEventListener('click', () => {
            if (currentIndex - itemsPerPage >= 0) {
                currentIndex -= itemsPerPage;
            }
            showItems();
        });

        // Khởi động hiển thị ban đầu
        showItems();
    });
</script>

<hr class="w-2/2 mb-12 mt-16 border-t-1 border-gray-300 opacity-50 mx-auto">

<!-- Collection Best -->
<h2 class="text-white text-4xl font-semibold mb-12 mt-16">All Collections</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @foreach ($best as $item)
        <a href="{{ route('client.collection.details', $item->id) }}"
           class="group block bg-neutral-900 rounded-md overflow-hidden 
                  hover:bg-neutral-800 transition-all duration-300 shadow-sm hover:shadow-xl">
            <div class="overflow-hidden">
                <img src="{{ asset('storage/' . $item->thumbnail) }}"
                     class="w-full h-93 object-cover transform transition-transform duration-300 group-hover:scale-105"
                     alt="{{ $item->name }}" />
            </div>

            <div class="p-4">
                <h3 class="text-white text-xl font-semibold group-hover:underline">
                    {{ $item->name }}
                </h3>
                <p class="text-gray-300 mt-2 text-sm line-clamp-3">
                    {{ $item->description }}
                </p>
            </div>
        </a>
    @endforeach
</div>
    </div>
@endsection

<style>
    /* Nếu bạn cần custom thêm hiệu ứng */
.carousel-button {
    transition: transform 0.3s ease-in-out;
}

</style>
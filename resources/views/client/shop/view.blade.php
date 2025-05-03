@extends('layouts.app')

@section('title')
    {{ __('Boutique Collection') }}
@endsection

@php
    $searching = request()->get('q') ?? '';
@endphp

@section('content')
    <div class="px-4 lg:px-8">
    <x-ui.breadcrumb :is-admin="0" is-dark :breadcrumbs="[['url' => 'client.shop', 'label' => 'Product']]" />

        <!-- Elegant Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl lg:text-4xl font-light tracking-wide text-white mb-3">
            Our Selected Products
            </h1>
            <p class="text-gray-300 max-w-2xl mx-auto text-sm">
                Discover products crafted in an ancient style
            </p>
        </div>

        <!-- Compact Search -->
        <div class="max-w-lg mx-auto mb-12">
            <form action="{{ route('client.shop') }}" method="GET">
                <div class="relative">
                    <input type="search" name="q" value="{{ $searching }}"
                           class="w-full p-3 pl-10 text-sm bg-transparent border border-gray-600 rounded-none focus:border-white text-white placeholder-gray-400 focus:outline-none transition-all duration-300"
                           placeholder="Search our collection..." />
                    <button type="submit" class="absolute left-3 top-3 text-gray-400 hover:text-white transition-colors">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Featured Collection - Compact Cards -->
        <section class="mb-16">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-light tracking-wider text-white border-b border-gray-600 pb-2">
                    Featured Product
                </h2>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach ($data->take(10) as $item)
                <div class="group relative bg-black transition-all duration-300 hover:bg-white hover:shadow-lg">
                    <a href="{{ route('client.shop.details', $item->id) }}" class="block">
                        <div class="aspect-[3/4] overflow-hidden">
                            <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                 class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-105"
                                 alt="{{ $item->name }}" />
                        </div>
                        <div class="p-3 group-hover:text-black">
    <h3 class="text-white font-semibold text-base mb-1 truncate group-hover:text-black">
        {{ $item->name }}
    </h3>
    <p class="text-yellow-400 text-sm mb-2 group-hover:text-yellow-500">
        ${{ number_format($item->price, 2) }}
    </p>
    @if($item->is_sale)
    <div>
        <a href="{{ route('cart.add', $item->id) }}"
           class="inline-block px-3 py-1 text-xs font-semibold text-black bg-white border border-gray-300 hover:bg-gray-100 transition-colors rounded group-hover:bg-black group-hover:text-white group-hover:border-black">
            + Add to Cart
        </a>
    </div>
    @endif
</div>

                    </a>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Minimal Pagination -->
        <div class="flex justify-center mb-12">
            {{ $data->links('pagination::simple-tailwind') }}
        </div>
    </div>
@endsection

<style>
    .pagination a, .pagination span {
        @apply px-3 py-1 text-gray-300 hover:text-white;
    }
    .pagination .active span {
        @apply text-white border-b border-white;
    }
</style>
@extends('layouts.app')

@section('title')
    {{ __('Chi tiết bộ sưu tập') }}
@endsection

@php
    $searching = request()->get('q') ?? '';
@endphp

@section('content')
    <div class="px-2">
        <x-ui.breadcrumb :is-admin="0" is-dark :breadcrumbs="[
            ['url' => 'client.collection', 'label' => 'Bộ sưu tập'],
            ['url' => 'client.collection.details', 'param' => $data->id, 'label' => 'Chi tiết bộ sưu tập'],
        ]" />

        <h1 class="text-2xl capitalize mt-2">
            {{ $data->title }}
        </h1>

        <div class="mb-3 mt-5">
            <h2 class="mb-1 font-bold tracking-tight text-gray-100">Ảnh tiêu đề:</h2>
            <img src="{{ asset('storage/' . $data->thumbnail) }}" alt="{{ $data->title }}" class="size-52 rounded-md">
        </div>

        <div class="mb-3 mt-5">
            <h2 class="mb-1 font-bold tracking-tight text-gray-100">Mô tả:</h2>
            <p class="mb-3 font-normal text-gray-400 test-sm">{{ $data->description }}</p>
        </div>

        <div class="mb-3 mt-5">
            <h2 class="mb-1 font-bold tracking-tight text-gray-100">Thuộc loại bộ sưu tập:</h2>
            <p class="mb-3 font-normal text-gray-400 test-sm">{{ $data->formatted_type }}</p>
        </div>

        @if ($data->is_sale)
            <div class="mb-3 mt-5">
                <h2 class="mb-1 font-bold tracking-tight text-gray-100 underline">Giá bán:</h2>
                <p class="mb-3 font-normal text-gray-400 test-sm">{{ $data->formatted_price . ' VND' }}</p>
            </div>
        @endif

        @if ($data->is_sale)
            <div class="mb-3 mt-3">
                <a href="{{ route('cart.add', $data->id) }}"
                    class="inline-flex mt-3 items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Thêm giỏ hàng
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                            clip-rule="evenodd" />
                    </svg>

                </a>
            </div>
        @endif

        <div class="mb-3 mt-5">
            <h2 class="mb-1 font-bold tracking-tight text-gray-100 underline">Danh sách ảnh:</h2>



            <div class="grid grid-cols-2 gap-2">
                @foreach ($data->images_json as $key => $image)
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/' . $image) }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

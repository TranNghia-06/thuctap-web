@extends('layouts.app')

@section('title')
    {{ __('Chi tiết buổi triển lãm') }}
@endsection

@section('content')
    <div class="text-white px-2">
        <x-ui.breadcrumb :is-admin="0" is-dark :breadcrumbs="[
            ['url' => 'client.exhibition', 'label' => 'Buổi triển lãm'],
            ['url' => 'client.ticket.details', 'label' => 'Chi tiết buổi triển lãm'],
        ]" />

        <h1 class="text-2xl capitalize mt-2">
            {{ $data->title }}
        </h1>

        <div class="mb-3 mt-5">
            <h2 class="mb-1 font-bold tracking-tight text-gray-100">Ảnh tiêu đề:</h2>
            <img src="{{ asset('storage/' . $data->image ?? '') }}" alt="{{ $data->title }}" class="size-52 rounded-md">
        </div>

        <div class="mb-3 mt-5">
            <h2 class="mb-1 font-bold tracking-tight text-gray-100">Mô tả:</h2>
            <p class="mb-3 font-normal text-gray-400 test-sm">{{ $data->description }}</p>
        </div>

        <div class="mb-3 mt-5">
            <h2 class="mb-1 font-bold tracking-tight text-gray-100 underline">Bắt đầu:</h2>
            <p class="mb-3 font-normal text-gray-400 test-sm">{{ $data->formatted_start_date }}</p>
        </div>

        <div class="mb-3 mt-5">
            <h2 class="mb-1 font-bold tracking-tight text-gray-100 underline">Kết thúc:</h2>
            <p class="mb-3 font-normal text-gray-400 test-sm">{{ $data->formatted_end_date }}</p>
        </div>

        <div class="mb-3 mt-5">
            <h2 class="mb-1 font-bold tracking-tight text-gray-100">Số lượng vé có sẵn:</h2>
            <p class="mb-3 font-normal text-gray-400 test-sm">
                <x-ui.badge type="green" :text="$data->is_limited_tickets ? $data->available_tickets : 'Không giới hạn'" />
            </p>
        </div>

        @if ($data->is_expired)
            <span class="text-xs text-red-500">{{ __('Hết hạn') }}</span>
        @else
            <div class="mb-3 mt-5">
                <a href="{{ route('client.exhibition.booking', $data->id) }}"
                    class="inline-flex mt-3 items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Đặt vé ngay
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                            clip-rule="evenodd" />
                    </svg>

                </a>
            </div>
        @endif
    </div>
@endsection

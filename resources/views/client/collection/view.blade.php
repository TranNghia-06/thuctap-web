@extends('layouts.app')

@section('title')
    {{ __('Danh sách bộ sưu tập') }}
@endsection

@section('content')
    <div class="px-2">
        <x-ui.breadcrumb :is-admin="0" is-dark :breadcrumbs="[['url' => 'client.collection', 'label' => 'Bộ sưu tập']]" />

        <h1 class="text-2xl text-white capitalize">
            danh sách bộ sưu tập
        </h1>

        <div class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-4">
            @forelse ($data as $item)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ route('client.collection.details', $item->id) }}">
                        <img class="h-[320px] rounded-t-lg object-cover aspect-video" src="{{ asset('storage/' . $item->thumbnail) }}"
                            alt="" />
                    </a>

                    <div class="p-5">
                        <a href="{{ route('client.collection.details', $item->id) }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white truncate">
                                {{ $item->name }}
                            </h5>
                        </a>

                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 line-clamp-1">
                            {{ $item->description }}
                        </p>

                        <p
                            class="font-normal line-clamp-1 text-gray-700">
                            <span class="font-semibold">Thuộc loại bộ sưu tập:</span>
                            {{ $item->formatted_type }}
                        </p>

                        <div>
                            @if ($item->is_sale)
                                <a href="{{ route('cart.add', $item->id) }}"
                                    class="inline-flex mt-3 items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    Thêm giỏ hàng
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif

                            <a href="{{ route('client.collection.details', $item->id) }}"
                                class="inline-flex mt-3 items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Xem chi tiết
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4">
                    <x-ui.alert type="warning">
                        Chưa có buổi triển lãm nào được lên lịch
                    </x-ui.alert>
                </div>
            @endforelse

        </div>
    </div>
@endsection

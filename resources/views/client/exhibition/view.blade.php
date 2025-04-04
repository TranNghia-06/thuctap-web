@extends('layouts.app')

@section('title')
    {{ __('Danh sách buổi triển lãm') }}
@endsection

@section('content')
    <div class="px-4 py-6">
        <x-ui.breadcrumb :is-admin="0" is-dark :breadcrumbs="[['url' => 'client.exhibition', 'label' => 'Buổi triển lãm']]" />

        <h1 class="mt-7 text-4xl text-white text-center capitalize">
            Danh Sách Buổi Triển Lãm
        </h1>

        <div class="mt-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($data as $item)
                <div class="exhibition-card bg-white dark:bg-gray-800">
                    <a href="{{ route('client.exhibition.details', $item->id) }}" class="block relative">
                        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $item->image) }}" alt="" />
                        @if ($item->is_expired)
                            <span class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                {{ __('Hết hạn') }}
                            </span>
                        @endif
                    </a>

                    <div class="p-5">
                        <a href="{{ route('client.exhibition.details', $item->id) }}">
                            <h5 class="mb-3 text-xl font-bold text-gray-900 dark:text-white line-clamp-2">
                                {{ $item->title }}
                            </h5>
                        </a>

                        <p class="mb-4 text-gray-600 dark:text-gray-300 line-clamp-2">
                            {{ $item->description }}
                        </p>

                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $item->formatted_start_date }}</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $item->formatted_end_date }}</span>
                            </div>
                        </div>

                        <div class="flex space-x-3">
                            @if ($item->is_upcoming && !$item->is_expired)
                                <a href="{{ route('client.exhibition.booking', $item->id) }}"
                                   class="btn-gradient flex-1 text-center py-2 px-4 rounded-lg">
                                    Đặt vé ngay
                                </a>
                            @endif
                            <a href="{{ route('client.exhibition.details', $item->id) }}"
                                class="btn-gradient flex-1 text-center py-2 px-4 rounded-lg">
                                Chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state col-span-3 p-6 rounded-lg text-center">
                    <x-ui.alert type="warning">
                        Chưa có buổi triển lãm nào được lên lịch
                    </x-ui.alert>
                </div>
            @endforelse
        </div>
    </div>
@endsection

<style>
.exhibition-card {
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    position: relative;
    border-radius: 0.5rem;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.exhibition-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.exhibition-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, #3B82F6, #3B82F6);
}

.exhibition-card img {
    transition: transform 0.3s ease;
    width: 100%;
    height: 12rem;
    object-fit: cover;
}

.exhibition-card:hover img {
    transform: scale(1.02);
}

.btn-gradient {
    background: linear-gradient(90deg, #3B82F6, #3B82F6);
    border: none;
    transition: all 0.3s;
    color: white;
    font-weight: 500;
}

.btn-gradient:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

.empty-state {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px dashed #3B82F6;
}
</style>
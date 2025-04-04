@extends('layouts.app')

@section('title')
    {{ __('Danh sách buổi triển lãm') }}
@endsection

@section('content')
    <div class="px-4 py-6">
        <x-ui.breadcrumb :is-admin="0" is-dark :breadcrumbs="[['url' => 'client.exhibition', 'label' => 'Buổi triển lãm']]" />

        <h1 class="mt-7 text-4xl text-white text-center font-bold">
            Danh Sách Buổi Triển Lãm
        </h1>

        <div class="mt-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($data as $item)
                <div class="exhibition-card group bg-white dark:bg-gray-800">
                    <a href="{{ route('client.exhibition.details', $item->id) }}" class="block relative overflow-hidden h-96">
                        <img class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105" 
                             src="{{ asset('storage/' . $item->image) }}" 
                             alt="{{ $item->title }}" />
                        <div class="image-overlay absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        @if ($item->is_expired)
                            <span class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                {{ __('Hết hạn') }}
                            </span>
                        @elseif($item->is_upcoming)
                            <span class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full">
                                {{ __('Sắp diễn ra') }}
                            </span>
                        @endif
                    </a>

                    <div class="p-6 flex flex-col">
                        <a href="{{ route('client.exhibition.details', $item->id) }}">
                            <h5 class="mb-2 text-xl font-bold text-gray-900 dark:text-white line-clamp-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                {{ $item->title }}
                            </h5>
                        </a>

                        <p class="mb-3 text-gray-600 dark:text-gray-300 line-clamp-2 text-sm">
                            {{ $item->description }}
                        </p>

                        <div class="space-y-1 mb-4">
                            <div class="flex items-center text-xs text-gray-700 dark:text-gray-300">
                                <svg class="w-3 h-3 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $item->formatted_start_date }}</span>
                            </div>
                            <div class="flex items-center text-xs text-gray-700 dark:text-gray-300">
                                <svg class="w-3 h-3 mr-1 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $item->formatted_end_date }}</span>
                            </div>
                        </div>

                        <div class="flex space-x-3 mt-2">
                            @if ($item->is_upcoming && !$item->is_expired)
                                <a href="{{ route('client.exhibition.booking', $item->id) }}"
                                   class="btn-booking flex-1 text-center py-2 px-3 rounded-lg text-sm transform group-hover:-translate-y-1 transition-transform">
                                    Đặt vé ngay
                                </a>
                            @else
                                <div class="flex-1"></div>
                            @endif
                            <a href="{{ route('client.exhibition.details', $item->id) }}"
                                class="btn-detail flex-1 text-center py-2 px-3 rounded-lg text-sm transform group-hover:-translate-y-1 transition-transform">
                                Chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state col-span-3 p-8 rounded-lg text-center">
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
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    position: relative;
    border-radius: 0.75rem;
    border: 1px solid rgba(0, 0, 0, 0.08);
    display: flex;
    flex-direction: column;
    background: white;
    z-index: 1;
}

.exhibition-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    border-color: rgba(59, 130, 246, 0.3);
    z-index: 10;
}

.exhibition-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, #3B82F6, #4F46E5);
    transition: all 0.3s ease;
}

.exhibition-card:hover::before {
    height: 6px;
    background: linear-gradient(90deg, #4F46E5, #3B82F6);
}

.image-overlay {
    background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%);
}

/* Nút Đặt vé ngay */
.btn-booking {
    background: linear-gradient(135deg, #3B82F6, #4F46E5);
    border: none;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    color: white;
    font-weight: 500;
    min-width: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 38px;
    box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
}

/* Nút Chi tiết */
.btn-detail {
    background: white;
    border: 2px solid #3B82F6;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    color: #3B82F6;
    font-weight: 500;
    min-width: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 38px;
}

.btn-booking:hover, .btn-detail:hover {
    opacity: 0.95;
    transform: translateY(-2px) !important;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.btn-booking:hover {
    background: linear-gradient(135deg, #4F46E5, #3B82F6);
}

.btn-detail:hover {
    background: #f8fafc;
    color: #2563eb;
    border-color: #2563eb;
}

.empty-state {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px dashed #3B82F6;
}

/* Dark mode */
.dark .exhibition-card {
    background: #1f2937;
    border-color: rgba(255, 255, 255, 0.1);
}

.dark .exhibition-card:hover {
    border-color: rgba(59, 130, 246, 0.5);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.25), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
}

.dark .btn-detail {
    background: #1f2937;
    color: #93c5fd;
    border-color: #3B82F6;
}

.dark .btn-detail:hover {
    background: #1e40af;
    color: white;
}

.grid {
    align-items: stretch;
}

@media (max-width: 768px) {
    .exhibition-card a {
        height: 80vw;
        max-height: 24rem;
    }
}
</style>
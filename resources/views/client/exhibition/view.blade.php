@extends('layouts.app')

@section('title')
    {{ __('Danh sách buổi triển lãm') }}
@endsection

@section('content')
<div class="bg-black px-4 py-10 min-h-screen">
    <h1 class="text-white text-5xl font-bold text-center mb-12">List Of Exhibitions</h1>

    {{-- Thanh ngang trước "Exhibition of the Month" --}}
    <hr class="w-1/2 mb-12 mt-16 border-t-1 border-gray-300 opacity-50 mx-auto">
    {{-- Tiêu đề Exhibition of the Month --}}
    <div class="mb-8">
        <h2 class="text-white text-4xl font-semibold">Exhibition of the Month</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse ($data->take(3) as $item) <!-- Lấy 3 buổi triển lãm đầu tiên -->
            <a href="{{ route('client.exhibition.details', $item->id) }}"
               class="block bg-neutral-900 rounded-lg overflow-hidden flex flex-col text-white shadow-md transform transition duration-300 hover:scale-105 group">
                
                {{-- Hình ảnh --}}
                <div class="relative h-103 overflow-hidden">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" />
                </div>

                {{-- Nội dung --}}
                <div class="p-6 flex flex-col gap-4 flex-1">
                    {{-- Tag Free và thời gian bắt đầu/kết thúc nằm ngang --}}
                    <div class="flex items-center gap-4 mb-4">
                        {{-- Tag Free --}}
                        <div class="w-16 h-16 rounded-full bg-white text-black flex items-center justify-center text-sm font-semibold shadow transition duration-300 group-hover:scale-110">
                            Free
                        </div>

                        {{-- Thời gian bắt đầu --}}
                        <div class="flex items-center text-xs text-white font-semibold">
                            <svg class="w-3 h-3 mr-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $item->formatted_start_date }}</span>
                        </div>
                        
                        {{-- Thời gian kết thúc --}}
                        <div class="flex items-center text-xs text-white font-semibold">
                            <svg class="w-3 h-3 mr-1 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $item->formatted_end_date }}</span>
                        </div>
                    </div>

                    {{-- Tiêu đề --}}
                    <h2 class="text-xl font-bold leading-snug text-white transition duration-300 group-hover:underline group-hover:scale-[1.02] origin-left">
                        {{ $item->title }}
                    </h2>

                    {{-- Mô tả --}}
                    <p class="text-sm text-gray-300 line-clamp-4">
                        {{ $item->description }}
                    </p>

                    {{-- Nút Chi tiết --}}
                    <div class="mt-auto">
                        <div class="inline-flex items-center justify-between w-full bg-black text-white px-4 py-3 rounded-md text-sm font-medium border border-white transition-all duration-300 group-hover:bg-white group-hover:text-black group-hover:scale-105">
                        Detail
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-3 text-center text-white p-10 border-2 border-dashed border-white rounded-lg">
                <p>No exhibitions have been scheduled yet.</p>
            </div>
        @endforelse
    </div>

    <hr class="w-1/2 mb-12 mt-16 border-t-1 border-gray-300 opacity-50 mx-auto">

    {{-- Tiêu đề Special Exhibition --}}
    <div class="mt-10 mb-8">
        <h2 class="text-white text-4xl font-semibold">Special Event</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse ($data->skip(3) as $item) <!-- Lấy các buổi triển lãm tiếp theo -->
            <a href="{{ route('client.exhibition.details', $item->id) }}"
               class="block bg-neutral-900 rounded-lg overflow-hidden flex flex-col text-white shadow-md transform transition duration-300 hover:scale-105 group">
                
                {{-- Hình ảnh --}}
                <div class="relative h-103 overflow-hidden">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" />
                </div>

                {{-- Nội dung --}}
                <div class="p-6 flex flex-col gap-4 flex-1">
                    {{-- Tag Free và thời gian bắt đầu/kết thúc nằm ngang --}}
                    <div class="flex items-center gap-4 mb-4">
                        {{-- Tag Free --}}
                        <div class="w-16 h-16 rounded-full bg-white text-black flex items-center justify-center text-sm font-semibold shadow transition duration-300 group-hover:scale-110">
                            Free
                        </div>

                        {{-- Thời gian bắt đầu --}}
                        <div class="flex items-center text-xs text-white font-semibold">
                            <svg class="w-3 h-3 mr-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $item->formatted_start_date }}</span>
                        </div>
                        
                        {{-- Thời gian kết thúc --}}
                        <div class="flex items-center text-xs text-white font-semibold">
                            <svg class="w-3 h-3 mr-1 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $item->formatted_end_date }}</span>
                        </div>
                    </div>

                    {{-- Tiêu đề --}}
                    <h2 class="text-xl font-bold leading-snug text-white transition duration-300 group-hover:underline group-hover:scale-[1.02] origin-left">
                        {{ $item->title }}
                    </h2>

                    {{-- Mô tả --}}
                    <p class="text-sm text-gray-300 line-clamp-4">
                        {{ $item->description }}
                    </p>

                    {{-- Nút Chi tiết --}}
                    <div class="mt-auto">
                        <div class="inline-flex items-center justify-between w-full bg-black text-white px-4 py-3 rounded-md text-sm font-medium border border-white transition-all duration-300 group-hover:bg-white group-hover:text-black group-hover:scale-105">
                        Details
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-3 text-center text-white p-10 border-2 border-dashed border-white rounded-lg">
                <p>No exhibitions have been scheduled yet.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

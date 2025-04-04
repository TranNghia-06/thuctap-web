@extends('layouts.app')

@section('title')
    {{ __('Danh sách bài viết') }}
@endsection

@php
    $searching = request()->get('q') ?? '';
@endphp

@section('content')
    <div class="px-2">
        <x-ui.breadcrumb :is-admin="0" is-dark :breadcrumbs="[['url' => 'client.exhibition', 'label' => 'Bài viết']]" />

        <h1 class="mt-7 text-4xl text-white text-center capitalize">
            danh sách bài viết
        </h1>

        <form class="mt-20 max-w-md mx-auto" action="{{ route('client.post') }}" method="GET">
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



        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($data as $item)
        <div class="mt-6 relative bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 overflow-hidden hover:shadow-xl transition duration-300">
            <!-- Hình ảnh cũng là một liên kết -->
            <a href="{{ route('client.post.details', $item->id) }}" class="block relative">
                <img class="h-[430px] w-full object-cover transition-transform duration-300 hover:scale-105" src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" />
            </a>

            <div class="p-5">
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                    <span class="font-medium">Tác giả:</span> {{ $item->user->name }} | 
                    <span class="font-medium">Thời gian:</span> {{ $item->formatted_created_at }}
                </p>

                <!-- Tiêu đề là một liên kết -->
                <a href="{{ route('client.post.details', $item->id) }}" class="block text-xl font-bold text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition duration-300">
                    {{ $item->title }}
                </a>

                <p class="text-gray-700 dark:text-gray-300 line-clamp-2">
                    {{ $item->content_text }}
                </p>
            </div>
        </div>
    @empty
        <div class="col-span-3 text-center">
            <x-ui.alert type="warning">
                {{ $searching ? 'Không tìm thấy bài viết với từ khoá ' . $searching . '' : 'Chưa có bài viết nào' }}
            </x-ui.alert>
        </div>
    @endforelse
</div>
    </div>
@endsection

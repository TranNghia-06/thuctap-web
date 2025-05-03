@extends('layouts.app')

@section('title')
    {{ __('List of Articles') }}
@endsection

@php
    $searching = request()->get('q') ?? '';
@endphp

@section('content')
    <div class="px-2">
        <x-ui.breadcrumb :is-admin="0" is-dark :breadcrumbs="[['url' => 'client.exhibition', 'label' => 'Article']]" />

        <h1 class="mt-7 text-5xl text-white text-center capitalize">
            List of articles
        </h1>


        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($data as $item)
        <div class="mt-6 relative bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 overflow-hidden hover:shadow-xl transition duration-300">
            <!-- Image is also a link -->
            <a href="{{ route('client.post.details', $item->id) }}" class="block relative">
                <img class="h-[430px] w-full object-cover transition-transform duration-300 hover:scale-105" src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" />
            </a>

            <div class="p-5">
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                    <span class="font-medium">Author:</span> {{ $item->user->name }} | 
                    <span class="font-medium">Date:</span> {{ $item->formatted_created_at }}
                </p>

                <!-- Title is a link -->
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
                {{ $searching ? 'No articles found for the keyword ' . $searching . '' : 'No articles available' }}
            </x-ui.alert>
        </div>
    @endforelse
</div>
    </div>
@endsection

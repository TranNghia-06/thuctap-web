@extends('layouts.app')

@section('title')
    {{ __('Collection Details') }}
@endsection

@section('content')
    <div class="bg-black text-white px-6 py-8 min-h-screen">
        {{-- Breadcrumb --}}
        <x-ui.breadcrumb :is-admin="0" :breadcrumbs="[
            ['url' => 'client.collection', 'label' => 'Collection'],
            ['url' => 'client.collection.details', 'param' => $data->id, 'label' => 'Collection Details'],
        ]" />

        {{-- Title --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold tracking-wide">{{ $data->title }}</h1>
            <p class="text-gray-400 mt-2 italic">{{ $data->formatted_type }}</p>
        </div>

        {{-- Main Image --}}
        <div class="flex justify-center mb-10">
            <img src="{{ asset('storage/' . $data->thumbnail) }}"
                alt="{{ $data->title }}"
                class="rounded-2xl shadow-2xl max-w-3xl w-72 h-[550px] object-cover">
        </div>

        {{-- Description and Price (if available) --}}
        <div class="max-w-4xl mx-auto text-lg space-y-6 mb-12">
            <div>
                <h2 class="text-2xl font-semibold mb-2">📝 Description</h2>
                <p class="text-gray-300 leading-relaxed">{{ $data->description }}</p>
            </div>

            @if ($data->is_sale)
                <div>
                    <h2 class="text-2xl font-semibold mb-2">💰 Price</h2>
                    <p class="text-green-400 text-2xl font-bold">{{ $data->formatted_price }} VND</p>

                    <a href="{{ route('cart.add', $data->id) }}"
                        class="inline-flex mt-4 items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-full transition-all duration-300 shadow-lg">
                        <span>Add to Cart</span>
                        <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>

        {{-- Additional Gallery --}}
        <!-- <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl font-semibold mb-4">🖼 Gallery</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($data->images_json as $image)
                    <div class="overflow-hidden rounded-xl shadow-xl hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('storage/' . $image) }}"
                            alt="Collection Image"
                            class="w-full h-60 object-cover">
                    </div>
                @endforeach
            </div>
        </div> -->
    </div>
@endsection

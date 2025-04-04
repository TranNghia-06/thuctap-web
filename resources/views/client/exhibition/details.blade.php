@extends('layouts.app')

@section('title')
    {{ __('Chi tiết buổi triển lãm') }}
@endsection

@section('content')
    <div class="px-4 py-6 bg-white text-black min-h-screen">
        <x-ui.breadcrumb :is-admin="0" :breadcrumbs="[
            ['url' => 'client.exhibition', 'label' => 'Buổi triển lãm'],
            ['url' => 'client.ticket.details', 'label' => 'Chi tiết buổi triển lãm'],
        ]" />

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6 bg-white border border-gray-200 p-6 rounded-xl shadow-md">
            {{-- Cột trái: Hình ảnh --}}
            <div class="flex justify-center items-start">
                <img src="{{ asset('storage/' . $data->image ?? '') }}"
                     alt="{{ $data->title }}"
                     class="rounded-xl object-cover w-full max-w-md h-auto shadow-sm border border-gray-300">
            </div>

            {{-- Cột phải: Thông tin --}}
            <div class="flex flex-col justify-start">
                <h1 class="text-3xl font-bold mb-4 border-b border-gray-300 pb-2">{{ $data->title }}</h1>

                <div class="space-y-3 text-base text-gray-700">
                    <div>
                        <h2 class="font-semibold text-lg text-gray-900 mb-1">📝 Mô tả</h2>
                        <p>{{ $data->description }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h2 class="font-semibold text-lg text-gray-900 mb-1">📅 Bắt đầu</h2>
                            <p>{{ $data->formatted_start_date }}</p>
                        </div>
                        <div>
                            <h2 class="font-semibold text-lg text-gray-900 mb-1">📆 Kết thúc</h2>
                            <p>{{ $data->formatted_end_date }}</p>
                        </div>
                    </div>

                    <div>
                        <h2 class="font-semibold text-lg text-gray-900 mb-1">🎟️ Vé còn lại</h2>
                        <x-ui.badge type="green" :text="$data->is_limited_tickets ? $data->available_tickets : 'Không giới hạn'" />
                    </div>

                    @if ($data->is_expired)
                        <span class="text-red-600 font-medium">⛔ Buổi triển lãm đã kết thúc</span>
                    @else
                        <a href="{{ route('client.exhibition.booking', $data->id) }}"
                           class="mt-5 inline-block w-max px-5 py-2.5 text-sm font-semibold text-white bg-green-600 rounded-lg shadow hover:bg-green-700 transition">
                            Đặt vé ngay
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title')
    {{ __('Đặt vé cho buổi triển lãm') }}
@endsection

@section('content')
    <div class="bg-white text-gray-900 px-4 py-6 min-h-screen">
        <x-ui.breadcrumb :is-admin="0" :breadcrumbs="[
            ['url' => 'client.exhibition', 'label' => 'Buổi triển lãm'],
            ['url' => 'client.exhibition.details', 'param' => $data->id, 'label' => $data->title],
            ['url' => 'client.exhibition.booking', 'param' => $data->id, 'label' => 'Đặt vé cho buổi triển lãm'],
        ]" />

        <h1 class="text-3xl font-bold mt-6 mb-4">{{ $data->title }}</h1>

        @if (session('error'))
            <x-ui.alert type="danger">
                {{ session('error') }}
            </x-ui.alert>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            {{-- Thông tin triển lãm --}}
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 shadow-sm space-y-4">
                <h2 class="text-xl font-semibold">📝 Mô tả</h2>
                <p class="text-gray-700">{{ $data->description }}</p>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="font-semibold">📅 Bắt đầu</h3>
                        <p>{{ $data->formatted_start_date }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold">📆 Kết thúc</h3>
                        <p>{{ $data->formatted_end_date }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="font-semibold">🎟️ Vé có sẵn</h3>
                    <x-ui.badge type="green" :text="$data->is_limited_tickets ? $data->available_tickets : 'Không giới hạn'" />
                </div>

                @if ($data->is_expired)
                    <p class="text-red-500 font-medium mt-3">⛔ Buổi triển lãm đã kết thúc</p>
                @endif
            </div>

            {{-- Form đặt vé --}}
            @if (!$data->is_expired)
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow space-y-5">
                    <h2 class="text-xl font-semibold mb-4">📩 Thông tin đặt vé</h2>

                    <form action="{{ route('client.exhibition.booking', $data->id) }}" method="POST" class="space-y-5">
                        @csrf

                        <x-form.input-field
                            :light="true"
                            name="ticket_count"
                            label="Số lượng vé"
                            type="number"
                            :value="old('ticket_count') ?? 1"
                            required
                            placeholder="VD: 2 vé"
                            min="1"
                        />

                        <x-form.textarea-field
                            :light="true"
                            name="details"
                            label="Ghi chú"
                            :value="old('details')"
                            placeholder="VD: Tôi muốn chọn chỗ gần cổng vào..."
                        />

                        <button type="submit"
                            class="w-full flex justify-center items-center px-4 py-2 text-white bg-green-600 hover:bg-green-700 rounded-lg font-medium transition">
                            Đặt vé
                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection

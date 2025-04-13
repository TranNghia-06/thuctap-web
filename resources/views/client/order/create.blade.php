@extends('layouts.app')

@section('title')
    {{ __('Mua hàng') }}
@endsection

@php
    $columns = ['Tên sản phẩm', 'Số lượng', 'Đơn giá', 'Tổng tiền'];
    $totalPrice = 0;
    $totalQuantity = 0;
@endphp

@section('content')
    <div class="text-white px-4">
        <x-ui.breadcrumb :is-admin="0" is-dark :breadcrumbs="[
            ['url' => 'cart', 'label' => 'Giỏ hàng'],
            ['url' => 'client.post.details', 'label' => 'Tiến hành mua hàng'],
        ]" />
    </div>

    <div class="mt-6 px-4">
        <section class="bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6 md:p-10">
            <form action="{{ route('order.create') }}" method="POST" class="space-y-8">
                @csrf

                <div class="max-w-3xl mx-auto space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ __('Thông tin đơn hàng') }}
                    </h2>

                    <x-form.textarea-field name="notes" label="Ghi chú" :value="old('notes')"
                        placeholder="Hãy nhập ghi chú." />

                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-800">
                        <table class="w-full table-auto text-left text-gray-900 dark:text-white">
                            <thead class="bg-gray-100 dark:bg-gray-800 text-sm font-semibold">
                                <tr>
                                    @foreach ($columns as $col)
                                        <th class="px-4 py-3">{{ $col }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-base">
                                @foreach ($data as $id => $item)
                                    @php
                                        $itemTotal = $item['price'] * $item['quantity_buy'];
                                        $totalPrice += $itemTotal;
                                        $totalQuantity += $item['quantity_buy'];
                                    @endphp
                                    <tr>
                                        <td class="px-4 py-4 flex items-center gap-4">
                                            <a href="{{ route('client.collection.details', $id) }}" class="w-12 h-12 flex-shrink-0">
                                                <img src="{{ asset('storage/' . $item['thumbnail']) }}" class="rounded-md w-full h-full object-cover" alt="{{ $item['name'] }}">
                                            </a>
                                            <a href="{{ route('client.collection.details', $id) }}" class="hover:underline">
                                                {{ $item['name'] }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-4">x{{ $item['quantity_buy'] }}</td>
                                        <td class="px-4 py-4">{{ number_format($item['price']) }} VND</td>
                                        <td class="px-4 py-4 font-semibold">
                                            {{ number_format($itemTotal) }} VND
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Tổng quan đơn hàng -->
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                            {{ __('Tổng quan về đơn hàng') }}
                        </h3>

                        <div class="bg-gray-100 dark:bg-gray-800 rounded-xl shadow-sm p-6 space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400">{{ __('Tổng đơn giá') }}</span>
                                <span class="font-medium text-gray-900 dark:text-white">
                                    {{ number_format($totalPrice) }} VND
                                </span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400">{{ __('Tổng số lượng') }}</span>
                                <span class="font-medium text-green-600 dark:text-green-400">
                                    {{ $totalQuantity }}
                                </span>
                            </div>

                            <div class="border-t border-gray-300 dark:border-gray-700 pt-4 mt-4 flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900 dark:text-white">
                                    {{ __('Tổng tiền') }}
                                </span>
                                <span class="text-2xl font-extrabold text-blue-600 dark:text-blue-400">
                                    {{ number_format($totalPrice) }} VND
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Nút hành động -->
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-4 pt-6">
                        <a href="{{ route('client.collection') }}"
                            class="w-full text-center rounded-lg border border-gray-300 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                            {{ __('Quay lại') }}
                        </a>

                        <button type="submit"
                            class="w-full rounded-lg bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 text-white px-5 py-3 text-sm font-medium dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                            {{ __('Mua hàng') }}
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection

@extends('layouts.app')

@section('title')
    {{ __('Shopping Cart') }}
@endsection

@php
    $columns = ['Product Name', 'Quantity', 'Unit Price', 'Total Price', 'Remove'];
@endphp

@section('content')
    <div class="text-white px-2">
        <x-ui.breadcrumb :is-admin="0" is-dark :breadcrumbs="[['url' => 'cart', 'label' => 'Shopping Cart']]" />

        <h1 class="text-2xl capitalize mt-2">
            {{ __('Your shopping cart') }}
        </h1>

        @if (session('error'))
            <x-ui.alert type="danger">
                {{ session('error') }}
            </x-ui.alert>
        @endif

        @if (session('success'))
            <x-ui.alert type="success">
                {{ session('success') }}
            </x-ui.alert>
        @endif

        <div class="mt-4">
            <x-ui.table :columns="$columns">
                <x-slot:body>
                    @forelse ($data as $id => $item)
                        <x-ui.table-row>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{ route('client.shop.details', $id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    {{ $item['name'] }}
                                </a>
                            </th>

                            <td class="px-6 py-4  truncate max-w-[100px]">
                                {{ $item['quantity_buy'] }}
                            </td>

                            <td class="px-6 py-4  truncate max-w-[100px]">
                                {{ number_format($item['price']) . ' VND' }}
                            </td>

                            <td class="px-6 py-4  truncate max-w-[100px]">
                                {{ number_format($item['price'] * $item['quantity_buy']) . ' VND' }}
                            </td>

                            <td class="text-nowrap">
                                <a href={{ route('cart.remove', $id) }}
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline ml-4">
                                    {{ __('Remove') }}
                                </a>
                            </td>
                        </x-ui.table-row>
                    @empty
                        <x-ui.table-row>
                            <td class="px-6 py-4 text-center dark:text-white" colspan="{{ count($columns) }}">
                                <span>
                                    {{ __('Your cart is empty') }}
                                </span>

                                <a href="{{ route('client.shop') }}">
                                    <span class="text-blue-600 dark:text-blue-500 hover:underline ml-4">
                                        {{ __('Continue shopping') }}
                                    </span>
                                </a>
                            </td>
                        </x-ui.table-row>
                    @endforelse
                </x-slot:body>
            </x-ui.table>
        </div>

        @if (count($data) > 0)
            <div class="mt-4 flex justify-end">
                <div>
                    <x-ui.button href="{{ route('client.shop') }}" class="!bg-green-500">
                        {{ __('Go back') }}
                    </x-ui.button>
                </div>
                <div class="ms-2">
                    <x-ui.button href="{{ route('order.create') }}">
                        {{ __('Proceed to checkout') }}
                    </x-ui.button>
                </div>
            </div>
        @endif
    </div>
@endsection

<script>
    setTimeout(() => {
        document.querySelector('#alert')?.remove();
    }, 3000);
</script>

@extends('layouts.app')

@section('title')
    {{ __('Book a Museum Ticket') }}
@endsection

@section('content')
<div class="bg-gray-100 min-h-screen py-12 px-6">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-4xl font-semibold text-center text-gray-800 mb-8">Book a Museum Ticket</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 border border-green-400 rounded-lg p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('client.museum_ticket.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="block text-lg font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="form-input mt-2 block w-full border border-gray-300 rounded-lg p-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="form-input mt-2 block w-full border border-gray-300 rounded-lg p-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone" class="block text-lg font-medium text-gray-700">Phone Number</label>
                <input type="text" id="phone" name="phone" class="form-input mt-2 block w-full border border-gray-300 rounded-lg p-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <!-- Visit Date -->
            <div class="form-group">
                <label for="visit_date" class="block text-lg font-medium text-gray-700">Visit Date</label>
                <input type="date" id="visit_date" name="visit_date" class="form-input mt-2 block w-full border border-gray-300 rounded-lg p-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <!-- Ticket Quantity -->
            <div class="form-group">
                <label for="quantity" class="block text-lg font-medium text-gray-700">Number of Tickets</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1" class="form-input mt-2 block w-full border border-gray-300 rounded-lg p-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <!-- Ticket Price -->
            <div class="form-group">
                <label class="block text-lg font-medium text-gray-700">Ticket Price (VND)</label>
                <input type="text" id="ticket_price" value="50000" readonly class="form-input mt-2 block w-full border border-gray-300 rounded-lg p-4 text-gray-500 bg-gray-100">
            </div>

            <!-- Total Price -->
            <div class="form-group">
                <label class="block text-lg font-medium text-gray-700">Total Price (VND)</label>
                <input type="text" id="total_price_display" readonly class="form-input mt-2 block w-full border border-gray-300 rounded-lg p-4 text-gray-700 bg-gray-100">
                <!-- Hidden field to send total price to server -->
                <input type="hidden" name="total_price" id="total_price">
            </div>

            <!-- Submit Button -->
            <div class="form-group text-center">
                <button type="submit" class="w-full py-3 bg-indigo-600 text-white text-lg font-medium rounded-lg shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Book Ticket
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const pricePerTicket = 50000;
    const quantityInput = document.getElementById('quantity');
    const totalPriceDisplay = document.getElementById('total_price_display');
    const totalPriceHidden = document.getElementById('total_price');

    function updateTotalPrice() {
        const quantity = parseInt(quantityInput.value) || 0;
        const total = pricePerTicket * quantity;
        totalPriceDisplay.value = total.toLocaleString('en-US');
        totalPriceHidden.value = total;
    }

    quantityInput.addEventListener('input', updateTotalPrice);
    window.addEventListener('DOMContentLoaded', updateTotalPrice);
</script>
@endsection

@extends('layouts.app')

@section('title')
    {{ __('Museum Ticket Booking History') }}
@endsection

@section('content')
<div class="bg-gray-100 min-h-screen py-10 px-4">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Museum Ticket Booking History</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($tickets->isEmpty())
            <p class="text-center text-gray-600">You have not booked any tickets yet. Book now to visit the museum!</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                    <thead>
                        <tr class="bg-indigo-600 text-white text-left">
                            <th class="px-4 py-3 text-sm">No.</th>
                            <th class="px-4 py-3 text-sm">Name</th>
                            <th class="px-4 py-3 text-sm">Email</th>
                            <th class="px-4 py-3 text-sm">Phone Number</th>
                            <th class="px-4 py-3 text-sm">Visit Date</th>
                            <th class="px-4 py-3 text-sm">Quantity</th>
                            <th class="px-4 py-3 text-sm">Total Price</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y divide-gray-200">
                        @foreach($tickets as $index => $ticket)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $ticket->name }}</td>
                                <td class="px-4 py-3">{{ $ticket->email }}</td>
                                <td class="px-4 py-3">{{ $ticket->phone }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($ticket->visit_date)->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">{{ $ticket->quantity }}</td>
                                <td class="px-4 py-3 font-semibold text-indigo-600">
                                    {{ number_format($ticket->price * $ticket->quantity, 0, ',', '.') }} VND
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection

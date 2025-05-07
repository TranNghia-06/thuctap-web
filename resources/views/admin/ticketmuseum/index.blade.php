@extends('layouts.dashboard')

@section('title')
    {{ __('visit tickets') }}
@endsection

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-center mb-8">Manage Visit Tickets</h2>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success bg-green-100 text-green-700 border border-green-400 rounded-lg p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger bg-red-100 text-red-700 border border-red-400 rounded-lg p-4 mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tickets table -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-200 text-gray-600">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3">Visit Date</th>
                    <th class="px-6 py-3">Quantity</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr class="border-t border-gray-200">
                        <td class="px-6 py-3">{{ $ticket->name }}</td>
                        <td class="px-6 py-3">{{ $ticket->email }}</td>
                        <td class="px-6 py-3">{{ $ticket->phone }}</td>
                        <td class="px-6 py-3">{{ $ticket->visit_date }}</td>
                        <td class="px-6 py-3">{{ $ticket->quantity }}</td>
                        <td class="px-6 py-3">
                            @if($ticket->status == 'pending')
                                <span class="text-yellow-500">Pending</span>
                            @elseif($ticket->status == 'confirmed')
                                <span class="text-green-500">Confirmed</span>
                            @elseif($ticket->status == 'canceled')
                                <span class="text-red-500">Canceled</span>
                            @elseif($ticket->status == 'paid')
                                <span class="text-blue-500">Paid</span>
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            <!-- Actions -->
                            @if($ticket->status == 'pending')
                                <a href="{{ route('admin.ticketmuseum.accept', $ticket->id) }}" class="text-green-600 hover:text-green-800">Accept</a> |
                                <a href="{{ route('admin.ticketmuseum.reject', $ticket->id) }}" class="text-red-600 hover:text-red-800">Reject</a>
                            @elseif($ticket->status == 'confirmed')
                                <a href="{{ route('admin.ticketmuseum.markAsPaid', $ticket->id) }}" class="text-blue-600 hover:text-blue-800">Mark as Paid</a>
                            @else
                                <span class="text-gray-500">No actions available</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

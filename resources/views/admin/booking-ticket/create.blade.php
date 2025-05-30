@extends('layouts.dashboard')

@section('title')
    {{ __('On-site Ticket Booking') }}
@endsection

@section('content')
    <x-ui.breadcrumb :breadcrumbs="[
        ['url' => 'admin.ticket', 'label' => 'Ticket Management'],
        ['url' => 'admin.ticket.create', 'label' => 'On-site Booking'],
    ]" />

    <form class="space-y-4 md:space-y-6 mt-8" action="{{ route('admin.ticket.create') }}" method="POST">
        @csrf

        @if (session('error'))
            <x-ui.alert type="danger">
                {{ session('error') }}
            </x-ui.alert>
        @endif

        <div>
            <label for="exhibition_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                {{ __('Exhibition') }}
            </label>

            <select required id="exhibition_id" name="exhibition_id" onchange="handleExhibitionChange(this.value)"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="" disabled>{{ __('Select an exhibition') }}</option>
                @if (old('exhibition_id'))
                    @foreach ($exhibition_list as $exhibition)
                        @if ($exhibition->id === old('exhibition_id'))
                            <option value="{{ $exhibition->id }}" selected>
                                {{ $exhibition->title }}
                            </option>
                        @else
                            <option value="{{ $exhibition->id }}">
                                {{ $exhibition->title }}
                            </option>
                        @endif;
                    @endforeach
                @else
                    @foreach ($exhibition_list as $exhibition)
                        <option value="{{ $exhibition->id }}">
                            {{ $exhibition->title }}
                        </option>
                    @endforeach
                @endif
            </select>

            @error('exhibition_id')
                <p class="text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <x-form.input-field readonly name="total_price" label="Ticket Price" :value="old('total_price')" required
            placeholder="e.g. Select an exhibition" min="0" />

        <x-form.input-field readonly name="start_date" label="Start Time" :value="old('start_date')" required
            placeholder="e.g. Select an exhibition" min="0" />

        <x-form.input-field readonly name="end_date" label="End Time" :value="old('end_date')" required
            placeholder="e.g. Select an exhibition" min="0" />

        <x-form.input-field name="ticket_count" label="Number of Tickets" type="number" :value="old('ticket_count') ?? 1" required
            placeholder="e.g. Enter number of tickets" min="1" />

        <x-form.textarea-field name="details" label="Notes" :value="old('details') ?? 'On-site booking'" required
            placeholder="e.g. Booked for customer: John Doe - Phone: 0123456789"
            description="e.g. Booked for customer: John Doe - Phone: 0123456789" />

        <x-ui.button type="submit" class="w-full md:w-auto">
            {{ __('Book Ticket') }}
        </x-ui.button>
    </form>
@endsection
<script>
    function handleExhibitionChange(event) {
        const exhibitionId = event;

        console.log('Selected Exhibition ID:', exhibitionId);

        const body = {
            'id': exhibitionId
        }

        const formatPrice = (price) => {
            return Number(price) <= 0 ? 'Free' : new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(price);
        }

        const formatDate = (date) => {
            return new Intl.DateTimeFormat('vi-VN', {
                year: 'numeric',
                month: 'numeric',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric'
            }).format(new Date(date));
        }

        fetch('{{ route('api.exhibition.details') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(body)
        }).then(response => response.json())
            .then(data => {
                console.log(`Exhibition Data:`, data)

                const total_price = data.price;
                const start_date = data.start_date;
                const end_date = data.end_date;

                document.querySelector('input[name="total_price"]').value = formatPrice(total_price);
                document.querySelector('input[name="start_date"]').value = formatDate(start_date);
                document.querySelector('input[name="end_date"]').value = formatDate(end_date);
            });
    }
</script>

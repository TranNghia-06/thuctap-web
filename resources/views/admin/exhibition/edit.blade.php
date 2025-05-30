@extends('layouts.dashboard')

@section('title')
    {{ __('Edit Exhibition') }}
@endsection

@section('content')
    <x-ui.breadcrumb :breadcrumbs="[
        ['url' => 'admin.exhibition', 'label' => 'Exhibitions'],
        ['url' => 'admin.exhibition.edit', 'label' => 'Edit Exhibition'],
    ]" />

    <form class="space-y-4 md:space-y-6 mt-8" action="{{ route('admin.exhibition.edit', $data->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf

        <x-form.input-field name="title" label="Exhibition Title" :value="old('title') ?? $data->title" required
            placeholder="E.g. Art Exhibition" />

        <x-form.textarea-field name="description" label="Exhibition Description" :value="old('description') ?? $data->description" required
            placeholder="E.g. Short description of the exhibition" />

        <x-form.input-field name="total_tickets" label="Number of Tickets" type="number" :value="old('total_tickets') ?? ($data->total_tickets ?? 0)" required
            placeholder="••••••••" description="If set to 0, the tickets will be unlimited." min="0" />

        <x-form.input-field name="start_date" label="Start Date" :value="old('start_date') ?? $data->start_date" type="datetime-local" required
            placeholder="••••••••" />

        <x-form.input-field name="end_date" label="End Date" :value="old('end_date') ?? $data->end_date" type="datetime-local" required
            placeholder="••••••••" />

        <div>
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                {{ __('Status') }}
            </label>
            <select required id="status" name="status"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="" disabled>{{ __('Select Status') }}</option>
                @if ($data->status ?? old('status'))
                    <option value="active" {{ ($data->status ?? old('status')) === 'active' ? 'selected' : '' }}>
                        {{ __('Visible') }}</option>
                    <option value="inactive" {{ ($data->status ?? old('status')) === 'inactive' ? 'selected' : '' }}>
                        {{ __('Hidden') }}</option>
                @else
                    <option value="active">{{ __('Visible') }}</option>
                    <option value="inactive">{{ __('Hidden') }}</option>
                @endif
            </select>

            @error('status')
                <p class="text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image">Cover Image</label>
            <input type="file" name="image" id="image" accept="image/*" onchange="previewAvatar(event)">

            <img id="imgReview" src="{{ asset('storage/' . $data->image) }}" class="w-16 h-16 rounded-md mt-2"
                alt="Image Preview">

            @error('image')
                <p class="text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <x-ui.button type="submit" class="w-full md:w-auto">
            {{ __('Save Changes') }}
        </x-ui.button>
    </form>
@endsection

<script>
    function previewAvatar(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imgReview');
            output.classList.remove('hidden');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

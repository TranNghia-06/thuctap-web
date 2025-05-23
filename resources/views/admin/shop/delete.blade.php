@extends('layouts.dashboard')

@section('title')
    {{ __('Delete Product') }}
@endsection

@section('content')
    <x-ui.breadcrumb :breadcrumbs="[ 
        ['url' => 'admin.shop', 'label' => 'Product Management'],
        ['url' => 'admin.shop.create', 'label' => 'Delete Product'],
    ]" />

    <form novalidate class="space-y-4 md:space-y-6 mt-8" action="{{ route('admin.shop.delete', $data->id) }}"
        method="POST" enctype="multipart/form-data">
        @csrf

        @if (session('error'))
            <x-ui.alert type="danger">
                {{ session('error') }}
            </x-ui.alert>
        @endif

        <x-ui.alert type="warning">
            Please note, this action cannot be undone. Make sure to carefully consider before deleting.
        </x-ui.alert>

        <x-form.input-field name="name" label="Product Name" :value="old('name') ?? $data->name" readonly
            placeholder="Enter product name" />

        <div>
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                {{ __('Product Category') }}
            </label>

            <select disabled id="category" name="category"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="" disabled>{{ __('Select product category') }}</option>
                @if (old('category') ?? $data->category)
                    <option value="clothing" {{ (old('category') ?? $data->category) === 'clothing' ? 'selected' : '' }}>
                        {{ __('Clothing') }}
                    </option>
                    <option value="accessories" {{ (old('category') ?? $data->category) === 'accessories' ? 'selected' : '' }}>
                        {{ __('Accessories') }}</option>
                    <option value="jewelry" {{ (old('category') ?? $data->category) === 'jewelry' ? 'selected' : '' }}>
                        {{ __('Jewelry') }}</option>
                    <option value="electronics" {{ (old('category') ?? $data->category) === 'electronics' ? 'selected' : '' }}>
                        {{ __('Electronics') }}</option>
                    <option value="others" {{ (old('category') ?? $data->category) === 'others' ? 'selected' : '' }}>
                        {{ __('Others') }}</option>
                @else
                    <option value="clothing">{{ __('Clothing') }}</option>
                    <option value="accessories">{{ __('Accessories') }}</option>
                    <option value="jewelry">{{ __('Jewelry') }}</option>
                    <option value="electronics">{{ __('Electronics') }}</option>
                    <option value="others">{{ __('Others') }}</option>
                @endif
            </select>

            @error('category')
                <p class="text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <x-form.textarea-field name="description" label="Short Description" :value="old('description') ?? $data->description" readonly
            placeholder="Enter a short description" />

        <x-form.input-field name="price" label="Price" type="number" :value="old('price') ?? ($data->price ?? 0)" readonly
            placeholder="Enter price" min="0"
            description="The default price is 0 if the product is only for display and not for sale." />

        <x-form.input-field name="quantity" label="Quantity" type="number" :value="old('quantity') ?? ($data->quantity ?? 0)" readonly
            placeholder="Example: Enter quantity" min="0" description="Quantity of product on display and available for sale." />

        <div>
            <label for="is_public" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                {{ __('Status') }}
            </label>

            <select disabled id="is_public" name="is_public"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="" disabled>{{ __('Select status') }}</option>
                @if (old('is_public') ?? isset($data->is_public))
                    @php
                        $is_public = old('is_public') ?? ($data->is_public ? 'true' : 'false');
                    @endphp

                    <option value="true" {{ $is_public === 'true' ? 'selected' : '' }}>
                        {{ __('Visible') }}
                    </option>
                    <option value="false" {{ $is_public === 'false' ? 'selected' : '' }}>
                        {{ __('Not visible') }}
                    </option>
                @else
                    <option value="true">{{ __('Visible') }}</option>
                    <option value="false">{{ __('Not visible') }}</option>
                @endif
            </select>

            @error('is_public')
                <p class="text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="thumbnail">Thumbnail Image</label>

            <img id="imgReview" src="{{ asset('storage/' . $data->thumbnail) }}" class="w-16 h-16 rounded-md mt-2"
                alt="Image Preview">

            @error('thumbnail')
                <p class="text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <label for="images">Image List</label>

            <div id="imagePreviewContainer" class="mt-2 flex gap-3 flex-wrap">
                @foreach ($data->images_json as $image)
                    <div class="relative w-16 h-16">
                        <img src="{{ asset('storage/' . $image) }}" alt="Image Preview"
                            class="w-full h-full rounded-md border object-cover">
                    </div>
                @endforeach
            </div>

            @error('images')
                <p class="text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col md:flex-row md:space-x-4">
            <x-ui.button type="submit" class="w-full md:w-auto bg-red-500 hover:bg-red-600">
                {{ __('Delete Product') }}
            </x-ui.button>

            <x-ui.button :href="route('admin.shop')" class="w-full md:w-auto">
                {{ __('Cancel') }}
            </x-ui.button>
        </div>
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

    function previewImages(event) {
        const container = document.getElementById("imagePreviewContainer");
        const files = Array.from(event.target.files);

        files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageWrapper = document.createElement("div");
                imageWrapper.className = "relative w-16 h-16";

                const img = document.createElement("img");
                img.className = "w-full h-full rounded-md border object-cover";
                img.src = e.target.result;

                const deleteBtn = document.createElement("button");
                deleteBtn.className =
                    "absolute -top-2 -right-2 bg-red-500 text-white w-5 h-5 flex items-center justify-center rounded-full text-xs hover:bg-red-600 cursor-pointer";
                deleteBtn.innerHTML = "×";
                deleteBtn.onclick = function() {
                    imageWrapper.remove();
                    files.splice(index, 1); // Remove image from the list
                };

                imageWrapper.appendChild(img);
                imageWrapper.appendChild(deleteBtn);
                container.appendChild(imageWrapper);
            };
            reader.readAsDataURL(file);
        });
    }

    function removeImage(image) {
        let images = JSON.parse(document.getElementById('images-input').value);

        if (typeof images === 'object') {
            images = Object.values(images);
        }

        images = images.filter(img => img !== image);
        document.getElementById('images-input').value = JSON.stringify(images);
        event.target.parentElement.remove();
    }
</script>

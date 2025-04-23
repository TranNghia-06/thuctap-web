@extends('layouts.app')

@section('title')
    {{ __('Post Details') }}
@endsection

@section('content')
    <div class="px-4 md:px-10 lg:px-20 py-6 text-white">
        <x-ui.breadcrumb :is-admin="0" is-dark :breadcrumbs="[
            ['url' => 'client.post', 'label' => 'Articles'],
            ['url' => 'client.post.details', 'param' => $data->id, 'label' => 'Post Details'],
        ]" />

        <!-- Post Info -->
        <div class="mb-6 mt-6 text-gray-300">
            <p class="flex items-center gap-2 text-lg">
                <i class="fas fa-user-circle text-blue-400"></i> 
                <span class="font-medium">{{ $data->user->name }} ({{ $data->user->email }})</span>
            </p>
            <p class="flex items-center gap-2 text-sm mt-1">
                <i class="fas fa-calendar-alt text-yellow-400"></i>
                <span>{{ $data->formatted_created_at }}</span>
            </p>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold text-white">
            {{ $data->title }}
        </h1>

        <!-- Main Image and Content -->
        <div class="flex flex-col md:flex-row items-start gap-6 mb-6">
            <!-- Image -->
            <div class="mt-6 w-full md:w-1/2">
                <img src="{{ asset('storage/' . $data->thumbnail ?? '') }}" 
                    alt="{{ $data->title }}" 
                    class="w-full h-auto max-h-[800px] object-cover rounded-lg shadow-lg">
            </div>

            <!-- Description -->
            <div class="mt-6 w-full md:w-1/2 text-gray-300">
                <div class="mt-4 text-gray-400 text-[18px] text-justify">
                    {!! $data->content_html !!}
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('client.post') }}" class="inline-flex items-center px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                <i class="fas fa-arrow-left mr-2"></i> Back to post list
            </a>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            fetch("{{ route('post.increase.view', $data->id) }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                }
            });
        }, 5000);
    });
</script>

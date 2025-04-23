@extends('layouts.app')

@section('title')
    {{ __('Account Settings') }}
@endsection

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-xl rounded-2xl mt-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white text-center">
        Account Settings
    </h2>

    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-800 rounded-lg mb-4 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('client.user.setting') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Avatar (optional)</label>
            <input type="file" name="avatar" class="w-full text-gray-900 dark:text-white">
            @if ($user->avatar)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="w-20 h-20 rounded-full ring-2 ring-gray-300 dark:ring-gray-600">
                </div>
            @endif
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">New Password (optional)</label>
            <input type="password" name="password"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="pt-4 text-right">
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Update Profile
            </button>
        </div>
    </form>
</div>
@endsection

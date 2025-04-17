@extends('layouts.dashboard')

@section('title')
    {{ __('Quản lý cấu hình') }}
@endsection

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-3xl font-semibold mb-6 text-gray-900">Cấu hình hệ thống</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-12a1 1 0 011 1v3a1 1 0 01-2 0V7a1 1 0 011-1zm0 6a1 1 0 011 1v3a1 1 0 01-2 0v-3a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div x-data="{ tab: 'contact' }">
        <!-- Tab buttons -->
        <div class="flex space-x-6 border-b-2 mb-6">
            <button @click="tab = 'contact'" 
                :class="tab === 'contact' ? 'border-b-4 border-indigo-600 text-indigo-600' : 'text-gray-600'"
                class="px-4 py-2 font-medium text-lg focus:outline-none">
                Thông tin liên hệ
            </button>
            <button @click="tab = 'social'" 
                :class="tab === 'social' ? 'border-b-4 border-indigo-600 text-indigo-600' : 'text-gray-600'"
                class="px-4 py-2 font-medium text-lg focus:outline-none">
                Mạng xã hội
            </button>
            <button @click="tab = 'logo'" 
                :class="tab === 'logo' ? 'border-b-4 border-indigo-600 text-indigo-600' : 'text-gray-600'"
                class="px-4 py-2 font-medium text-lg focus:outline-none">
                Logo & Website
            </button>
        </div>

        <form action="{{ route('admin.system_settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Tab 1: Thông tin liên hệ -->
            <div x-show="tab === 'contact'" class="space-y-6">
                <div class="space-y-4">
                    <label for="contact_email" class="block text-sm font-medium text-gray-700">Email liên hệ</label>
                    <input type="email" name="contact_email" id="contact_email"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2"
                        value="{{ $configurations['contact_email']->value ?? '' }}">
                </div>

                <div class="space-y-4">
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                    <input type="text" name="contact_phone" id="contact_phone"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2"
                        value="{{ $configurations['contact_phone']->value ?? '' }}">
                </div>

                <div class="space-y-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Địa chỉ</label>
                    <input type="text" name="address" id="address"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2"
                        value="{{ $configurations['address']->value ?? '' }}">
                </div>
            </div>

            <!-- Tab 2: Social -->
            <div x-show="tab === 'social'" class="space-y-6">
                @php
                    $fb = $configurations['facebook']->value ?? '';
                    $ig = $configurations['instagram']->value ?? '';
                    $tt = $configurations['tiktok']->value ?? '';
                    $yt = $configurations['youtube']->value ?? '';
                @endphp

                <div class="space-y-4">
                    <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook</label>
                    <input type="url" name="facebook" id="facebook"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2"
                        placeholder="https://facebook.com/yourpage" value="{{ old('facebook', $fb) }}">
                </div>

                <div class="space-y-4">
                    <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</label>
                    <input type="url" name="instagram" id="instagram"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2"
                        placeholder="https://instagram.com/yourprofile" value="{{ old('instagram', $ig) }}">
                </div>

                <div class="space-y-4">
                    <label for="tiktok" class="block text-sm font-medium text-gray-700">TikTok</label>
                    <input type="url" name="tiktok" id="tiktok"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2"
                        placeholder="https://tiktok.com/@yourhandle" value="{{ old('tiktok', $tt) }}">
                </div>

                <div class="space-y-4">
                    <label for="youtube" class="block text-sm font-medium text-gray-700">YouTube</label>
                    <input type="url" name="youtube" id="youtube"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2"
                        placeholder="https://youtube.com/channel/yourchannel" value="{{ old('youtube', $yt) }}">
                </div>
            </div>

            <!-- Tab 3: Logo -->
            <div x-show="tab === 'logo'" class="space-y-6">
                <div class="space-y-4">
                    <label for="site_name" class="block text-sm font-medium text-gray-700">Tên Website</label>
                    <input type="text" name="site_name" id="site_name"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2"
                        value="{{ $configurations['site_name']->value ?? '' }}">
                </div>

                <div class="space-y-4">
                    <label for="footer_text" class="block text-sm font-medium text-gray-700">Mô tả footer</label>
                    <textarea name="footer_text" id="footer_text" rows="3"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2">{{ $configurations['footer_text']->value ?? '' }}</textarea>
                </div>

                <div class="space-y-4">
                    <label for="logo" class="block text-sm font-medium text-gray-700">Logo Website</label>
                    <input type="file" name="logo" id="logo"
                        class="block w-full text-sm text-gray-700 mt-2">
                    @if (!empty($configurations['logo']->value))
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $configurations['logo']->value) }}" alt="Logo hiện tại" class="h-16">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Nút lưu -->
            <div class="pt-6">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-colors duration-300">
                    Lưu cấu hình
                </button>
            </div>
        </form>
    </div>
</div>

<!-- AlpineJS for tabs -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

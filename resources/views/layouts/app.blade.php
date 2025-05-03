<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script src="//unpkg.com/alpinejs" defer></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Favicon --}}
    @php
        $favicon = get_system_config('favicon');
    @endphp
    @if($favicon)
        <link rel="icon" href="{{ asset('storage/' . $favicon) }}" type="image/x-icon">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @endif

    <title>@yield('title') - {{ config('app.name', 'Museum') }}</title>

    <!-- Fonts & Styles & Scripts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css?family=Baskervville:400|Bellefair:400|Poppins:300,400|Roboto:300,500" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-gradient-hero {
            background: linear-gradient(32deg, rgba(17, 17, 17, 1) 0%, rgba(0, 0, 0, 0) 100%);
        }
        /* Google Translate styles */
        iframe.goog-te-banner-frame, body > .skiptranslate, #google_translate_element, .goog-logo-link, .goog-te-gadget span {
            display: none !important;
        }
        body {
            top: 0px !important;
            position: static !important;
        }
        .custom-translate select {
            padding: 4px 8px;
            border-radius: 5px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            font-size: 12px;
            color: #333;
            width: 100%;
            max-width: 150px;
        }
        @media (min-width: 640px) {
            .custom-translate select {
                padding: 6px 12px;
                font-size: 14px;
                max-width: 200px;
            }
        }
        @media (max-width: 640px) {
            .bg-gradient-hero {
                background: linear-gradient(32deg, rgba(17, 17, 17, 1) 0%, rgba(0, 0, 0, 0) 80%);
            }
        }
    </style>

    <!-- Google Translate -->
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'vi', autoDisplay: false }, 'google_translate_element');
        }
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>

@php
    $siteName = get_system_config('site_name', 'Chưa có tên Website');
    $words = explode(' ', $siteName);
@endphp

<body class="bg-[#0d0d0d]">
    <div class="w-full max-w-[1440px] mx-auto overflow-hidden">
        <!-- Navigation -->
        <nav class="bg-black text-white px-4 sm:px-6 py-4">
            <div class="w-full max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <!-- @if($logo = get_system_config('logo'))
                        <img src="{{ asset('storage/' . $logo) }}" alt="Logo" class="h-8 sm:h-10">
                    @endif -->
                    <div class="flex flex-col leading-none">
                        <span class="text-xs uppercase tracking-widest font-serif opacity-70">{{ $words[0] ?? '' }}</span>
                        <span class="text-2xl sm:text-3xl font-serif font-light">{{ $words[1] ?? '' }}</span>
                        <span class="text-2xl sm:text-3xl font-serif font-semibold">{{ $words[2] ?? '' }}</span>
                    </div>
                </a>
                <!-- Menu trung tâm -->
                <ul class="flex flex-col sm:flex-row gap-4 sm:gap-8 items-center mt-4 sm:mt-0">
                    <li><a href="{{ route('home') }}" class="hover:underline uppercase text-sm sm:text-base">Visit</a></li>
                    <li><a href="{{ route('client.exhibition') }}" class="hover:underline uppercase text-sm sm:text-base">Exhibitions & Events</a></li>
                    <li><a href="{{ route('client.shop') }}" class="hover:underline uppercase text-sm sm:text-base">Shop</a></li>
                    <li><a href="{{ route('client.collection') }}" class="hover:underline uppercase text-sm sm:text-base">Collection</a></li>
                    <li><a href="{{ route('client.post') }}" class="hover:underline uppercase text-sm sm:text-base">Post</a></li>
                </ul>
                <!-- Menu bên phải -->
                <div class="flex flex-col sm:flex-row items-center gap-4 mt-4 sm:mt-0">
                    <a href="{{ route('cart') }}" class="uppercase hover:underline text-sm sm:text-base">Shopping Cart</a>
                    @guest
                        <a href="{{ route('login') }}" class="uppercase hover:underline text-sm sm:text-base">Login</a>
                    @else
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="focus:outline-none">
                                <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('storage/images/logo4.jpg') }}"
                                     class="w-8 h-8 rounded-full" alt="User photo">
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
     class="absolute right-0 mt-2 bg-white text-black rounded shadow-lg z-50 w-[200px]">
    <div class="px-4 py-2 border-b">
        <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
        <p class="text-sm text-gray-600 break-words">{{ Auth::user()->email }}</p>
    </div>
    <ul>
        <li><a href="{{ route('client.exhibition.ticket.history') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Booking History</a></li>
        <li><a href="{{ route('client.post.history') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Post View History</a></li>
        <li><a href="{{ route('client.user.setting') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Account Settings</a></li>
        @if (Auth::user()->is_admin)
            <li><a href="{{ route('admin.post') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Admin Dashboard</a></li>
        @endif
        <li>
            <button data-modal-target="popup-modal-logout" data-modal-toggle="popup-modal-logout"
                    class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">Logout</button>
        </li>
    </ul>
</div>

                        </div>
                    @endguest
                    <div id="google_translate_element"></div>
                    <div class="custom-translate">
                        <select onchange="doGTranslate(this)">
                            <option value="">🌐 Language</option>
                            <option value="vi|vi">🇻🇳 Tiếng Việt</option>
                            <option value="vi|en">🇬🇧 English</option>
                            <option value="vi|ja">🇯🇵 Japanese</option>
                            <option value="vi|zh-CN">🇨🇳 Chinese</option>
                            <option value="vi|fr">🇫🇷 French</option>
                            <option value="vi|de">🇩🇪 German</option>
                            <option value="vi|es">🇪🇸 Spanish</option>
                            <option value="vi|ko">🇰🇷 Korean</option>
                            <option value="vi|th">🇹🇭 Thai</option>
                        </select>
                    </div>
                </div>
            </div>
            <script>
                function doGTranslate(lang_pair) {
                    if (lang_pair.value) {
                        var lang = lang_pair.value.split('|')[1];
                        var interval = setInterval(function () {
                            var select = document.querySelector('.goog-te-combo');
                            if (select) {
                                select.value = lang;
                                select.dispatchEvent(new Event('change'));
                                clearInterval(interval);
                            }
                        }, 100);
                    }
                }
            </script>
        </nav>

        @yield('content')

        <!-- Footer -->
        <footer class="w-full flex flex-col md:flex-row justify-between mt-12 bg-gray-100 text-gray-800 py-10 px-4 sm:px-10">
            <div class="mb-8 md:mb-0">
                <div class="text-yellow-500 text-xl sm:text-2xl font-semibold text-center mb-4 border-b-2 border-black pb-2">FOLLOW US</div>
                <div class="grid grid-cols-2 gap-4 sm:gap-6 text-black-500">
                    @if($facebook = get_system_config('facebook'))
                        <a href="{{ $facebook }}" target="_blank" class="cursor-pointer text-center hover:text-black-500 hover:font-bold">Facebook</a>
                    @endif
                    @if($tiktok = get_system_config('tiktok'))
                        <a href="{{ $tiktok }}" target="_blank" class="cursor-pointer text-center hover:text-black-500 hover:font-bold">TikTok</a>
                    @endif
                    @if($youtube = get_system_config('youtube'))
                        <a href="{{ $youtube }}" target="_blank" class="cursor-pointer text-center hover:text-black-500 hover:font-bold">YouTube</a>
                    @endif
                    @if($instagram = get_system_config('instagram'))
                        <a href="{{ $instagram }}" target="_blank" class="cursor-pointer text-center hover:text-black-500 hover:font-bold">Instagram</a>
                    @endif
                </div>
            </div>
            <div class="mb-8 md:mb-0">
                <div class="text-yellow-500 text-xl sm:text-2xl font-semibold border-b-2 border-black pb-2">MUSEUM INFORMATION</div>
                <div class="space-y-4 mt-4">
                    <div class="flex gap-3 items-center">
                        <img class="w-5 h-5 sm:w-6 sm:h-6" alt="Location icon" src="{{ asset('storage/images/icon-diachi.svg') }}">
                        <div class="text-black-500 text-sm sm:text-base">{{ get_system_config('address', 'Chưa có thông tin địa chỉ') }}</div>
                    </div>
                    <div class="flex gap-3 items-center">
                        <img class="w-5 h-5 sm:w-6 sm:h-6" alt="Phone icon" src="{{ asset('storage/images/icon-phone.svg') }}">
                        <div class="text-black-500 text-sm sm:text-base">{{ get_system_config('contact_phone', 'Chưa có số điện thoại') }}</div>
                    </div>
                    <div class="flex gap-3 items-center">
                        <img class="w-5 h-5 sm:w-6 sm:h-6" alt="Email icon" src="{{ asset('storage/images/icon-email.svg') }}">
                        <div class="text-black-500 text-sm sm:text-base">{{ get_system_config('contact_email', 'Chưa có email') }}</div>
                    </div>
                </div>
            </div>
            <section class="w-full md:w-[400px] flex flex-col items-center justify-center text-center py-8 bg-gray-200 rounded-lg shadow-md border border-gray-400">
                <div class="flex flex-col items-center space-y-4">
                    <div class="relative">
                        <img class="w-12 h-12 sm:w-16 sm:h-16 object-cover animate-pulse" alt="UXM logo" src="{{ asset('storage/images/logo.png') }}">
                    </div>
                    <h2 class="font-poppins text-yellow-500 text-base sm:text-lg font-semibold bg-gradient-to-r from-yellow-400 to-yellow-300 bg-clip-text text-transparent">
                        Jewelry Museum
                    </h2>
                    <p class="font-poppins text-gray-700 text-xs sm:text-sm px-4 italic leading-relaxed border-t border-gray-500 pt-4">
                        “ Thank you for taking the time to visit the  
                        <span class="text-yellow-500 font-medium">Vietnam Museum of Ancient Jewelry.</span>.  
                        Hope you have an enjoyable experience. See you again! ” 
                    </p>
                </div>
            </section>
        </footer>
        <hr class="custom-hr">
        <div class="bg-gray-100 text-gray-700 text-center py-3 text-sm sm:text-base">
            <p>{{ get_system_config('footer_text', 'Chưa có footer') }}</p>
        </div>

        <style>
            .custom-hr {
                width: 100%;
                margin: 0 auto;
                border: 1px solid rgba(211, 200, 200, 0.92);
            }
        </style>
    </div>

    <!-- Logout Modal -->
    <div id="popup-modal-logout" tabindex="-1"
         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[60] bg-gray-200/50 backdrop-blur-sm justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-[90%] sm:max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-modal-logout">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 sm:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-base sm:text-lg font-normal text-gray-500 dark:text-gray-400">
                        Are you sure you want to log out?
                    </h3>
                    <button data-modal-hide="popup-modal-logout"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes
                    </button>
                    <button data-modal-hide="popup-modal-logout" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        No
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
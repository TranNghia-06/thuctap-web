@extends('layouts.app')

@section('title')
    {{ __('Home') }}
@endsection

@section('content')
 <!-- Hero Section -->
<section class="relative w-full min-h-[100vh] sm:min-h-[800px] bg-[#0d0d0d] overflow-hidden">
    <!-- Background Image with Parallax -->
    <div class="absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat z-0"
         style="background-image: url('{{ asset('storage/images/tour2.jpg') }}');"
         x-data="{ offset: 0 }"
         x-init="window.addEventListener('scroll', () => offset = window.scrollY / 5)"
         :style="{ transform: `translateY(${offset}px)` }">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#4a2c2a]/70 via-transparent to-[#4a2c2a]/70 z-10"></div>
    </div>

    <!-- Content Container -->
    <div class="relative w-full max-w-[1440px] mx-auto px-4 sm:px-8 flex items-center justify-center min-h-[100vh] sm:min-h-[800px] z-20">
        <div class="bg-white/90 p-6 sm:p-8 rounded-lg shadow-lg text-center space-y-4 animate-fade-in">
            <h1 class="font-bellefair font-normal text-[#4a2c2a] text-3xl sm:text-5xl md:text-6xl tracking-tight leading-tight">
                Welcome to the Vietnam Antique Jewelry Museum
            </h1>
            <p class="font-poppins font-light text-[#4a2c2a] text-base sm:text-lg tracking-wide leading-relaxed max-w-[90%] sm:max-w-[500px] mx-auto">
                Discover the timeless beauty of ancient Vietnamese jewelry, where history and artistry intertwine in every precious piece.
            </p>
            <a href="{{ route('client.museum_ticket.create') }}"
   class="inline-block bg-black hover:bg-gray-600 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">
    Book your visit &gt;
</a>

        </div>
    </div>

    <!-- Control Buttons (Optional Video Controls) -->
    <div class="absolute bottom-4 right-4 flex space-x-2 z-30">
        <button class="w-10 h-10 bg-black/70 text-white rounded-full flex items-center justify-center hover:bg-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.665z" />
            </svg>
        </button>
        <button class="w-10 h-10 bg-black/70 text-white rounded-full flex items-center justify-center hover:bg-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
        </button>
        <button class="w-10 h-10 bg-black/70 text-white rounded-full flex items-center justify-center hover:bg-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
    </div>
</section> 

<!-- Jewelry Museum Hero Section -->
<section class="bg-black text-white py-16 px-8 md:px-20 border-b border-gray-700">
    <div class="max-w-screen-xl mx-auto flex flex-col md:flex-row justify-between items-center gap-10">
        <!-- Left: Title -->
        <div class="text-center md:text-left max-w-2xl">
            <h2 class="text-4xl md:text-5xl font-semibold leading-tight mb-6">
                Discover the Timeless Beauty <br class="hidden md:block" />
                of Vietnamese Heritage Jewelry
            </h2>
        </div>

        <!-- Right: Info List -->
        <div class="flex flex-col space-y-6 md:space-y-4 text-base md:text-lg font-poppins">
        <div class="flex items-center gap-3 group cursor-pointer hover:text-yellow-400 transition duration-300">
                <a href="{{ route('client.museum_ticket.create') }}" class="bg-white text-black font-semibold py-3 px-6 rounded-lg shadow-lg border-2 border-transparent group-hover:border-yellow-500 transition-all duration-300 hover:bg-yellow-500 hover:text-black focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h13V7H9V1H7v6H1v4h6v6h2zm2-6h8v2h-8v-2z"/>
                    </svg>
                    Book Tickets Online
                </a>
            </div>

            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span><strong>Open Today:</strong> 07:00 AM – 05:30 PM</span>
            </div>

            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span><strong>Last Entry:</strong> 05:30 PM</span>
            </div>
        </div>
    </div>
</section>


    <!-- Upcoming Events Section -->
    <section class="mt-20">
        <div class="flex justify-between relative">
            <div>
                <hr class="w-[197px] h-1 bg-[#727272]">

                <h2
                    class="font-Playfair Display font-bold  text-white text-[61.6px] tracking-[0] leading-[normal] whitespace-nowrap my-8">
                    Exhibition
                </h2>

                <hr class="w-[731px] h-1 bg-[#727272]">
            </div>
            <a href="{{ route('client.exhibition') }}" class="w-[115px] h-[115px] rounded-full border-[0.77px] border-solid border-white bg-transparent flex items-center justify-center transition-all duration-300 ease-in-out hover:bg-[#808080] hover:scale-105 -translate-x-4">
                <span class="font-bellefair font-normal text-white text-[22.1px] tracking-[0] leading-[normal] whitespace-nowrap">
                See more
                </span>
            </a>
            
        </div>
        <div id="slider" class="w-full relative p-0 flex items-end mt-12 h-[636px] bg-cover bg-[10%_90%] border-none rounded-none" 
     style="background-image: url('{{ asset('storage/images/tour.jpg') }}');">

     <script>
    const images = [
        "{{ asset('storage/images/tour.jpg') }}",
        "{{ asset('storage/images/thuvien.jpg') }}",
        "{{ asset('storage/images/sukien.jpg') }}"
    ];

    let index = 0;
    const slider = document.getElementById("slider");

    setInterval(() => {
        index = (index + 1) % images.length;
        slider.style.transition = "opacity 1s ease-in-out";
        slider.style.opacity = 0;

        setTimeout(() => {
            slider.style.backgroundImage = `url(${images[index]})`;
            slider.style.opacity = 1;
        }, 1000);
    }, 3000);
</script>

            <div class="flex justify-between pb-12 px-8 w-full z-10">
                <div class="flex items-center gap-10">
                    <div
                        class="font-bellefair font-normal text-[#e1e1e1] text-[67.6px] tracking-[0] leading-[normal] whitespace-nowrap">
                        01
                    </div>

                    <div class="space-y-2">
                        <div class="relative">
                            <div class="absolute -left-8 top-1 w-[23px] h-[23px] bg-[#828282] rounded-[11.52px]">
                                <div class="relative w-4 h-4 top-1 left-1 bg-neutral-100 rounded-[7.98px]"></div>
                            </div>
                            <h3 class="font-bellefair font-normal text-white text-[29.2px] tracking-[0] leading-[normal]">
                            THE SOUL OF TIME
                            </h3>
                        </div>

                        <div class="font-poppins font-normal text-white text-[12.5px] tracking-[0] leading-[normal]">
                        START: June 15 - 20, 2025.
                        </div>

                        <p
                            class="w-[629px] text-[15.9px] tracking-[1.03px] leading-[normal] font-poppins font-light text-white">
                            The exhibition Soul of Time Jewels offers a journey to discover ancient Vietnamese jewelry masterpieces through the dynasties.
                        </p>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-b from-transparent to-[rgba(0,0,0,0.50)] w-full h-[636px] absolute bottom-0 left-0 z-0">
            </div>
        </div>
    </section>
 




<!-- Exhibitions Section -->
<div class="py-20 mt-12 bg-neutral-900 px-4 md:px-20 text-white">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl md:text-4xl font-semibold">Exhibitions & Events</h2>
        <a href="{{ route('client.exhibition') }}" class="flex items-center gap-2 text-sm md:text-base font-semibold hover:underline transition">
            See all exhibitions and events
            <span class="text-xl">❯</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Exhibition 1 -->
        <div class="group bg-[#2f2f2f] hover:bg-white transition duration-300 flex flex-col md:flex-row overflow-hidden">
            <div class="p-6 flex-1">
                <h3 class="text-2xl font-bold mb-2 text-white group-hover:text-black transition">Royal Beauty</h3>
                <p class="text-gray-300 mb-8 group-hover:text-black transition">Vietnamese Antique Jewelry</p>
                <div class="text-sm mt-auto text-white group-hover:text-black transition">
                    <p class="font-semibold">Start on</p>
                    <p>15 – 17 May 2025</p>
                </div>
            </div>
            <div class="flex-1 overflow-hidden">
                <img src="{{ asset('storage/images/lam1.png') }}" alt="Exhibition 1" class="w-full h-full object-cover transition-transform transform group-hover:scale-110">
            </div>
        </div>

        <!-- Exhibition 2 -->
        <div class="group bg-[#2f2f2f] hover:bg-yellow-400 transition duration-300 flex flex-col md:flex-row overflow-hidden">
            <div class="p-6 flex-1">
                <h3 class="text-2xl font-bold mb-2 group-hover:text-black transition">Craftsmanship</h3>
                <p class="text-yellow-400 mb-8 font-semibold group-hover:text-black transition">Artisans and Heritage</p>
                <div class="text-sm mt-auto group-hover:text-black transition">
                    <p class="font-semibold">Start on</p>
                    <p>27 – 30 May 2025</p>
                </div>
            </div>
            <div class="flex-1 overflow-hidden">
                <img src="{{ asset('storage/images/lam4.jpg') }}" alt="Exhibition 2" class="w-full h-full object-cover transition-transform transform group-hover:scale-110">
            </div>
        </div>
    </div>
</div>


    <!-- Products Section -->
    <section class="mt-12">
        <div class="relative text-center flex justify-center overflow-hidden">
            <h2
                class="w-[881px] font-bellefair font-normal text-white text-[56.6px] text-center tracking-[0] leading-[normal]">
                COLLECTION
            </h2>

            <img class="absolute right-0 object-cover top-1/2 transform -translate-y-1/2 z-1 translate-x-28"
                alt="Decorative line" src="https://c.animaapp.com/m8peu9m38cRc1i/img/vector-40.svg">
            <img class="absolute left-0 object-cover top-1/2 transform -translate-y-1/2 -translate-x-28 z-1"
                alt="Decorative line" src="https://c.animaapp.com/m8peu9m38cRc1i/img/vector-40.svg">
        </div>



        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-16 px-4 md:px-16">
    {{-- Left Block – Hình ảnh lớn với overlay chữ --}}
    <div class="relative group overflow-hidden rounded-2xl shadow-xl">
        <img src="{{ asset('storage/images/kiengkimlien.jpg') }}"
            alt="Collection"
            class="w-full h-[500px] object-cover transform group-hover:scale-105 transition duration-500 ease-in-out">

        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

        <div class="absolute bottom-8 left-8 text-white z-10">
    <h2 class="text-5xl font-serif font-semibold tracking-wide">
    Featured Collection
    </h2>
    <p class="text-lg mt-2 text-gray-300 w-[80%]">A place to preserve the traditional beauty of Vietnam through each piece of jewelry.</p>
    <a href="{{ route('client.collection') }}"
        class="mt-4 inline-block px-6 py-3 bg-white text-black font-semibold rounded-full hover:bg-gray-100 transition">
        Explore Now
    </a>
</div>


    </div>

    {{-- Right Block – Ảnh phụ + nội dung giới thiệu --}}
    <div class="flex flex-col justify-between gap-6">
        

        <div class="flex gap-4 items-start">
            <img src="{{ asset('storage/images/vongtay.jpg') }}"
                alt="Item 3"
                class="w-32 h-32 object-cover rounded-lg shadow-md">
            <div>
                <h3 class="text-xl font-bold text-white">Royal Jade Bracelet</h3>
                <p class="text-gray-400 mt-1 text-sm">Symbol of luck and longevity in Eastern culture.</p>
            </div>
        </div>

        <div class="flex gap-4 items-start">
            <img src="{{ asset('storage/images/lacchan.jpg') }}"
                alt="Item 2"
                class="w-32 h-32 object-cover rounded-lg shadow-md">
            <div>
                <h3 class="text-xl font-bold text-white">Bronze Drum Silver Anklets</h3>
                <p class="text-gray-400 mt-1 text-sm">Bronze drum patterns symbolize prosperity, prosperity and stability in life.</p>
            </div>
        </div>

        <div class="flex gap-4 items-start">
            <img src="{{ asset('storage/images/tramcailada.jpg') }}"
                alt="Item 1"
                class="w-32 h-32 object-cover rounded-lg shadow-md">
            <div>
                <h3 class="text-xl font-bold text-white">Multi Leaf Brooch</h3>
                <p class="text-gray-400 mt-1 text-sm">Traditional Vietnamese jewelry, often crafted from gold, silver or bronze, features the shape of a soft banyan leaf.</p>
            </div>
        </div>
    </div>
</div>


        <div class="text-center mt-20 mb-16">
        <a href="{{ route('client.collection') }}">
            <button class="relative w-[290px] h-[95px] p-0 cursor-pointer transform hover:scale-105 transition duration-300 ease-in-out">
                <div class="z-0 absolute w-[95px] h-[95px] top-0 left-10 bg-[#363636] rounded-[47.58px]"></div>
                <span class="relative z-10 font-roboto font-medium text-white text-[30.7px] tracking-[0] leading-[normal] whitespace-nowrap">
                View all
                </span>
            </button>
        </a>
        </div>
    </section>

<!-- Our Shop Section - Inspired by British Museum -->
<section class="px-4 md:px-20">
    <div class="max-w-7xl mx-auto">
        <!-- Header with white background -->
        <div class="text-center mb-16 bg-white py-16 px-4">
            <h2 class="font-bellefair text-4xl md:text-5xl text-black mb-6">
                Welcome to the Vietnam Antique Jewelry Museum Shop
            </h2>
            <a href="{{ route('client.shop') }}" class="inline-block border-2 border-black text-black font-medium px-8 py-3 hover:bg-black hover:text-white transition duration-300">
                Shop now >>
            </a>
        </div>

        <!-- Product grid with black background -->
        <div class="bg-black py-20 px-4 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- Grid item -->
                @php
                    $items = [
                        ['title' => 'Inspired by the Museum', 'image' => 'vong_co_ly.jpg'],
                        ['title' => 'Tiger silver Ring', 'image' => 'nhanbac.jpg'],
                        ['title' => 'Turtle pendant', 'image' => 'meday.jpg'],
                        ['title' => 'Amethyst Necklace', 'image' => 'daychuyen.jpg'],
                    ];
                @endphp

                @foreach ($items as $item)
                    <div class="group transform transition duration-500 hover:scale-105 bg-black p-6 rounded-lg text-center">
                        <img src="{{ asset('storage/images/' . $item['image']) }}"
                             alt="{{ $item['title'] }}"
                             class="w-72 h-72 object-cover mx-auto rounded-lg shadow-md mb-4">
                        <h3 class="font-bellefair text-xl text-white transition-colors duration-300 group-hover:text-yellow-400">
                            {{ $item['title'] }}
                        </h3>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>



@endsection



<style>
    /* Tạo hiệu ứng chạy chữ từ trái qua phải collections*/
/* Tạo hiệu ứng chạy chữ liên tục */
@keyframes marquee {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
}

/* Áp dụng animation cho phần chữ */
.text-5xl {
    display: inline-block;
    white-space: nowrap; /* Đảm bảo chữ không bị xuống dòng */
    animation: marquee 10s linear infinite;
}



/* Fade-in Animation */
@keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 1s ease-out forwards;
    }

    /* Ensure visibility */
    section {
        position: relative !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Responsive Adjustments */
    @media (max-width: 640px) {
        .animate-fade-in {
            animation-delay: 0.2s;
        }
        .bg-gradient-to-r {
            background-image: linear-gradient(to right, #4a2c2a/70, transparent, #4a2c2a/70);
        }
        h1 { text-2xl sm:text-4xl }
        p { text-sm sm:text-base }
    }

</style>
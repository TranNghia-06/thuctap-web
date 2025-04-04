@extends('layouts.app')

@section('title')
    {{ __('Trang chủ') }}
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="relative w-[1760px] h-[2579px] -left-[160px]">
        <div
            class="absolute w-[1378px] h-[1378px] top-[133px] left-[382px] rounded-[689.07px] border-[17px] border-solid border-white blur-[10px]">
        </div>
        <div
            class="absolute w-[1378px] h-[1378px] top-[133px] left-[382px] rounded-[689.07px] border-[17px] border-solid border-white">
        </div>

        <img class="w-[1440px] h-[1418px] absolute top-0 left-[160px] object-cover" alt="Museum hero image"
            src="{{ asset('storage/images/tour2.jpg') }}">

        <div class="absolute w-[1630px] h-[425px] top-[1087px] left-0 bg-[#0d0d0d]"></div>



        <div class="absolute w-[1640px] h-[252px] top-[243px] left-[160px] bg-gradient-hero"></div>

        <div
            class="absolute w-[853px] h-[853px] top-[1309px] left-[457px] rounded-[426.43px] border-[10px] border-solid border-white blur-[15px]">
        </div>

        <div
            class="absolute w-[853px] h-[853px] top-[1309px] left-[457px] rounded-[426.43px] border-[10px] border-solid border-[#ffffffbd]">
        </div>

        <div class="absolute w-[531px] h-[1288px] top-[1292px] left-[160px] bg-black"></div>
        <div class="absolute w-[1665px] h-[765px] top-[1814px] left-[160px] bg-black"></div>

        <h1
            class="absolute w-[1140px] top-[275px] left-[320px] font-bellefair font-normal text-white text-[65px] text-center tracking-[0] leading-[normal]">
            BẢO TỒN LỊCH SỬ ĐỂ KIẾN TẠO TƯƠNG LAI
        </h1>

        <h2
            class="absolute w-[450px] top-[1330px] left-[303px] font-bellefair font-normal text-white text-[90px] tracking-[0] leading-[normal]">
            NƠI LƯU GIỮ NÉT ĐẸP VĂN HÓA
        </h2>
        <p
            class="absolute w-[810px] top-[2114px] left-[735px] font-poppins font-light text-white text-2xl tracking-[0] leading-[39.2px]">
            Bảo tàng Trang sức Cổ Việt Nam là không gian trưng bày những tuyệt tác trang sức mang đậm dấu ấn lịch sử và văn hóa dân tộc. Tại đây, bạn sẽ khám phá những bộ sưu tập tinh xảo từ các triều đại xưa, minh chứng cho nghệ thuật chế tác thủ công tinh tế và giá trị truyền thống quý báu. Không chỉ là nơi lưu giữ di sản, bảo tàng còn mang đến cơ hội trải nghiệm, mua sắm và tìm hiểu sâu hơn về vẻ đẹp vượt thời gian của trang sức cổ Việt Nam.
        </p>
        

        

        <hr class="absolute w-px h-[814px] top-[1268px] left-[767px] bg-white">
        <hr class="absolute w-[814px] h-px top-[1873px] left-[300px] bg-white">
        <hr class="absolute w-[941px] h-px top-[1345px] left-[707px] bg-white">
        <hr class="absolute w-px h-[941px] top-[1141px] left-[1487px] bg-white">

        <img class="w-[735px] h-[875px] absolute top-[1188px] left-[731px] object-cover" alt="Featured statue"
            src="{{ asset('storage/images/hienvatxoanen.png') }}">
    </section> 
    <!-- Upcoming Events Section -->
    <section class="mt-20">
        <div class="flex justify-between relative">
            <div>
                <hr class="w-[197px] h-1 bg-[#727272]">

                <h2
                    class="font-Playfair Display font-bold  text-white text-[71.6px] tracking-[0] leading-[normal] whitespace-nowrap my-8">
                    Buổi Triển Lãm
                </h2>

                <hr class="w-[731px] h-1 bg-[#727272]">
            </div>

            <a href="{{ route('client.exhibition') }}" class="w-[115px] h-[115px] rounded-full border-[0.77px] border-solid border-white bg-transparent flex items-center justify-center transition-all duration-300 ease-in-out hover:bg-[#808080] hover:scale-105 -translate-x-4">
                <span class="font-bellefair font-normal text-white text-[22.1px] tracking-[0] leading-[normal] whitespace-nowrap">
                    Xem thêm
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
                                HỒN NGỌC THỜI GIAN
                            </h3>
                        </div>

                        <div class="font-poppins font-normal text-white text-[12.5px] tracking-[0] leading-[normal]">
                            BẮT ĐẦU : 15 - 20 tháng 6, 2025 .
                        </div>

                        <p
                            class="w-[629px] text-[15.9px] tracking-[1.03px] leading-[normal] font-poppins font-light text-white">
                            Triển lãm Hồn Ngọc Thời Gian mang đến một hành trình khám phá những kiệt tác trang sức cổ Việt Nam qua các triều đại.
                        </p>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-b from-transparent to-[rgba(0,0,0,0.50)] w-full h-[636px] absolute bottom-0 left-0 z-0">
            </div>
        </div>
    </section>
  
    <!-- Carousel Section -->
    <div class="py-20 mt-12 bg-neutral-900">
        <div class="flex items-center justify-center">
            <div class="flex items-center justify-center">
                <img class="h-[370px] w-full object-cover translate-x-12 z-2" alt="Carousel image 1"
                    src="{{ asset('storage/images/anhnen4.png') }}">

                <img class="h-[500px]  object-cover z-10" alt="Carousel image 3"
                    src="{{ asset('storage/images/anhnen3.png') }}">

                <img class="h-[370px] w-full object-cover transform -translate-x-10 z-2" alt="Carousel image 2"
                    src="{{ asset('storage/images/anhnen4.png') }}">
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <section class="mt-12">
        <div class="relative text-center flex justify-center overflow-hidden">
            <h2
                class="w-[881px] font-bellefair font-normal text-white text-[76.6px] text-center tracking-[0] leading-[normal]">
                BỘ SƯU TẬP
            </h2>

            <img class="absolute right-0 object-cover top-1/2 transform -translate-y-1/2 z-1 translate-x-28"
                alt="Decorative line" src="https://c.animaapp.com/m8peu9m38cRc1i/img/vector-40.svg">
            <img class="absolute left-0 object-cover top-1/2 transform -translate-y-1/2 -translate-x-28 z-1"
                alt="Decorative line" src="https://c.animaapp.com/m8peu9m38cRc1i/img/vector-40.svg">
        </div>

        <div class="mt-12 flex gap-4 justify-end">

            <div class="p-0 relative">
                <div class="bg-gradient-to-b from-transparent to-[rgba(0,0,0,0.50)] absolute top-0 left-0 w-full h-full">
                </div>

                <img src="https://c.animaapp.com/m8peu9m38cRc1i/img/image-15.png " alt=""
                    class="w-[521px] h-full object-cover">

                <div class="absolute bottom-0 p-10">
                    <div
                        class="font-bellefair font-normal text-white text-[76.4px] tracking-[0] leading-[normal] whitespace-nowrap">
                        PRODUCT
                    </div>

                    <div class="font-roboto font-light text-white text-[26.1px] tracking-[6.53px] leading-[normal]">
                        Lorem ipsum dolor sit amet, consectetur
                    </div>

                </div>
            </div>


            <div>
                <img class="w-[580px] object-cover" alt="Product image"
                    src="https://c.animaapp.com/m8peu9m38cRc1i/img/image-15.png">
            </div>
        </div>

        <div class="text-center mt-20">
        <a href="{{ route('client.collection') }}">
            <button class="relative w-[290px] h-[95px] p-0 cursor-pointer transform hover:scale-105 transition duration-300 ease-in-out">
                <div class="z-0 absolute w-[95px] h-[95px] top-0 left-10 bg-[#363636] rounded-[47.58px]"></div>
                <span class="relative z-10 font-roboto font-medium text-white text-[30.7px] tracking-[0] leading-[normal] whitespace-nowrap">
                    Xem tất cả
                </span>
            </button>
        </a>
        </div>
    </section>
@endsection

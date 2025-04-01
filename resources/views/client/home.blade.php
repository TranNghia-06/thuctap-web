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

        

        

        <hr class="absolute w-px h-[814px] top-[1268px] left-[767px] bg-white">
        <hr class="absolute w-[814px] h-px top-[1873px] left-[300px] bg-white">
        <hr class="absolute w-[941px] h-px top-[1345px] left-[707px] bg-white">
        <hr class="absolute w-px h-[941px] top-[1141px] left-[1487px] bg-white">

        <img class="w-[735px] h-[875px] absolute top-[1188px] left-[731px] object-cover" alt="Featured statue"
            src="{{ asset('storage/images/hienvatxoanen.png') }}">
    </section>  
@endsection

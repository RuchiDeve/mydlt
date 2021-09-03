@extends('layouts.base')

@php

$member = \App\Models\User::query()->where('username', request('member'))->first();
$product = \App\Models\Website\Products::query()->inRandomOrder()->first();

@endphp

@section('base')

    <nav
            class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg"
    >
        <div
                class="container px-4 mx-auto flex flex-wrap items-center justify-between"
        >
            <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
                <div class="my-6 mr-4 px-3">
                    <a href="" class="bg-black text-white font-bold text-xl p-4">myDLT</a>
                </div>

            </div>

        </div>
    </nav>
    <main>
        <div
                class="relative pt-16 pb-32 flex content-center items-center justify-center"
                style="min-height: 75vh;"
        >
            <div class="absolute top-0 w-full h-full bg-center bg-cover"
                 style='background-image: url("{{\App\Models\Settings::getPhotoBgSetting()}}");'
            >
                <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
            </div>
            <div class="container relative mx-auto">
                <div class="items-center flex flex-wrap">
                    <div class="w-full lg:w-8/12 px-4 ml-auto mr-auto text-center">
                        <div class="pr-12">
                            <h1 class="text-white font-semibold text-5xl">
                                DLT Health-Plus Products
                            </h1>
                            <p class="mt-4 text-lg text-gray-300">
                                {{\App\Models\Settings::getMemberPageHeaderText()}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden"
                    style="height: 70px; transform: translateZ(0px);">
                <svg class="absolute bottom-0 overflow-hidden"
                     xmlns="http://www.w3.org/2000/svg"
                        preserveAspectRatio="none"
                        version="1.1"
                        viewBox="0 0 2560 100"
                        x="0"
                        y="0"
                >
                    <polygon class="text-gray-300 fill-current" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <section class="pb-20 bg-gray-300 -mt-24">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap items-center pt-32">
                    @if($product)
                    <div class="w-full md:w-5/12 px-4 mr-auto ml-auto">
                        <div class="text-gray-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-gray-100"
                        >
                            <i class="fas fa-coins text-xl"></i>
                        </div>
                        <h3 class="text-3xl mb-2 font-semibold leading-normal">
                            {{$product->name}}
                        </h3>
                        <p
                                class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700"
                        >
                            {!! $product->description !!}
                        </p>
                    </div>
                    @endif
                    <div class="w-full md:w-4/12 mr-auto ml-auto">
                        <div
                                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg bg-pink-600"
                        >
                            <iframe width="480" height="390"
                                    src="{{\App\Models\Settings::getVideoUrl()}}?controls=1&autoplay=1&mute=1">
                            </iframe>
                            {{--<span class="text-center mt-2 w-full text-red-400">...</span>--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-20 pb-48">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap justify-center text-center mb-24">
                    <div class="w-full lg:w-6/12 px-4">
                        <h2 class="text-4xl font-semibold">List of DLT-Health Plus Products</h2>
                        {{--<p class="text-lg leading-relaxed m-4 text-gray-600">
                            According to the National Oceanic and Atmospheric
                            Administration, Ted, Scambos, NSIDClead scentist, puts the
                            potentially record maximum.
                        </p>--}}
                    </div>
                </div>

                @livewire('products-listing')

            </div>
        </section>
        <section class="relative block bg-gray-900">
            <div class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
                 style="height: 80px; transform: translateZ(0px);">
                <svg
                        class="absolute bottom-0 overflow-hidden"
                        xmlns="http://www.w3.org/2000/svg"
                        preserveAspectRatio="none"
                        version="1.1"
                        viewBox="0 0 2560 100"
                        x="0"
                        y="0"
                >
                    <polygon
                            class="text-gray-900 fill-current"
                            points="2560 0 2560 100 0 100"
                    ></polygon>
                </svg>
            </div>
            <div class="container mx-auto px-4 lg:pt-24 lg:pb-24">
                <div class="flex flex-wrap text-center justify-center">
                    <div class="w-full lg:w-6/12 px-4">
                        <h2 class="text-4xl font-semibold text-white">Why choose DLT Health Plus?</h2>
                        <p class="text-lg leading-relaxed mt-4 mb-4 text-gray-500">
                            DLT-Health Plus is a must do, MLM network for all serious minded person who have chosen to build a reliable, lasting and legal financial empire. With the DLT-Health Plus massive Health and Wealth is achievable.
                        </p>
                    </div>
                </div>
                <div class="flex flex-wrap mt-12 justify-center">
                    <div class="w-full lg:w-3/12 px-4 text-center">
                        <div
                                class="text-gray-900 p-3 w-12 h-12 shadow-lg rounded-full bg-white inline-flex items-center justify-center"
                        >
                            <i class="fas fa-medal text-xl"></i>
                        </div>
                        <h6 class="text-xl mt-5 font-semibold text-white">
                            Transparent and Reliable Compensation plan
                        </h6>
                        <p class="mt-2 mb-4 text-gray-500">
                            Compensation plan is a key to success in any good MLM network company. Show me a successful MLM network company, I will show you a good and transparent compensation plan without any mystery behind it.
                        </p>
                    </div>
                    <div class="w-full lg:w-3/12 px-4 text-center">
                        <div
                                class="text-gray-900 p-3 w-12 h-12 shadow-lg rounded-full bg-white inline-flex items-center justify-center"
                        >
                            <i class="fas fa-poll text-xl"></i>
                        </div>
                        <h5 class="text-xl mt-5 font-semibold text-white">
                            Good, Efficacious and affordable Products
                        </h5>
                        <p class="mt-2 mb-4 text-gray-500">
                            In any MLM Network Company, compensation plan is one thing, product is another thing. The product maybe good but if the compensation plan is poor and confused, then it is not good enough. In the MLM industry a good product is as bad as a poor and confused compensation plan. The products are highly efficacious and curative.
                        </p>
                    </div>
                    <div class="w-full lg:w-3/12 px-4 text-center">
                        <div
                                class="text-gray-900 p-3 w-12 h-12 shadow-lg rounded-full bg-white inline-flex items-center justify-center"
                        >
                            <i class="fas fa-lightbulb text-xl"></i>
                        </div>
                        <h5 class="text-xl mt-5 font-semibold text-white">Easily Accessible Products</h5>
                        <p class="mt-2 mb-4 text-gray-500">
                            Most time the challenge of most networkers is the availability of products when needed. But with DLT-Health plus that challenge is now an old news. All products ingredients are locally source and produced locally in Nigeria
                        </p>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection

@push('scripts')

    <script>
        function toggleNavbar(collapseID) {
            document.getElementById(collapseID).classList.toggle("hidden");
            document.getElementById(collapseID).classList.toggle("block");
        }
    </script>

@endpush
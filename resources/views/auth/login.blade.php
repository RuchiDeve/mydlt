@extends('layouts.base')

@section('base')

    <div class="w-full flex flex-wrap">

        <!-- Login Section -->
        <div class="w-full md:w-1/2 flex flex-col">

            <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-24">
                <a href="#" class="bg-black text-white font-bold text-xl p-4">myDLT</a>
            </div>

            <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
                <p class="text-center text-3xl">Sign in to manage your MY-DLT account</p>

                @livewire('auth.login')

                <div class="text-center pt-12 pb-12">
                    <p>Don't have an account? <a href="/register" class="underline font-semibold">Register here.</a></p>
                </div>
            </div>

        </div>

        <!-- Image Section -->
        <div class="w-1/2 relative pt-16 pb-32 flex content-center items-center justify-center h-screen">
            <div class="absolute top-0 w-full h-full bg-center bg-cover"
                 style='background-image: url("{{\App\Models\Settings::getPhotoBgSetting()}}");'
            >
                <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
            </div>

            <div class="container relative mx-auto">
                <div class="items-center flex flex-wrap">
                    <div class="w-full lg:w-9/12 px-4 ml-auto mr-auto text-center">
                        <div class="pr-12">
                            <h1 class="text-white font-semibold text-3xl">
                                Build your DLT-Health Plus Network using MyDLT Landing Page in seconds
                            </h1>
                            <p class="mt-1 mb-12 text-lg text-gray-500">
                                JP Gettry said "I would rather choose to earn 1% of a hundred people's effort than to earn 100% of my personal effort"

                            </p>

                            <ul class="mb-12 text-gray-300">
                                <li>Promote your MyDLT website (Landing Page) on social media</li>
                                <li>Follow up with the visitors of your page</li>
                                <li>Make sure they don't just buy the products and leave.</li>
                                <li>Turn them to your DLT-Health Plus downlines.</li>
                            </ul>

                            <p class="mt-4 text-lg text-gray-200 text-2xl">
                                Congratulation you as you grow your network, using MyDLT as a added advantage.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
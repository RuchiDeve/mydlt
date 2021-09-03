@extends('layouts.base')

@section('base')

    <div class="w-full flex flex-wrap">

        <!-- Login Section -->
        <div class="w-full md:w-1/2 flex flex-col">

            <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">

                <div class="text-center pt-4 pb-2">
                    <a href="#" class="bg-black text-white font-bold text-xl p-4">myDLT</a>
                </div>

                <div class="text-center">

                    <span class="text-2xl">Sign up for a MyDLT account</span>
                    <br>
                    <span class="text-sm">
                        to create your own DLT Landing page (website),
                        in order to drive your DLT-Health Plus Network
                    </span>
                </div>

                @livewire('auth.register')

                <div class="text-center pt-6 pb-4">
                    <p>Already have an account? <a href="/login" class="underline font-semibold">Log in here.</a></p>
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
                                About MyDLT
                            </h1>
                            <p class="mt-1 mb-12 text-lg text-gray-500">
                                MyDLT is an online platform developed by DLT for all DLT-Health Plus members to help them drives online visitors to their DLT-Health Plus network, thereby helping them to grow their network
                            </p>

                            <p class="mb-12 text-gray-300">
                                <span class="text-2xl">How it Works</span>
                                <br>
                                As members advertise and promote their MyDLT website on all their social media handles to online visitors to buy DLT-Health Plus products, the visitors'contacts are sent directly to  the members whose MyDLT website was visited. It is left on the member to follow up with the visitors to turn them to a DLT-Health Plus member, under his or her network.
                            </p>

                            <p class="mt-4 text-lg text-gray-200 text-2xl">
                                DLT: Empowering lives!
                                DLT: Making Millionaire out of every home!!
                                DLT-Health Plus: Returning Man back to nature!!!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection





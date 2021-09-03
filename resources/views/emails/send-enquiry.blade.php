@extends('layouts.base')

@php

    /** @var \App\Models\User $recipient */
$recipient = $enquiry->user;

@endphp

@section('base')

    <section class="pt-20 pb-48 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center text-center mb-24">
                <div class="w-full lg:w-6/12 px-4">
                    <h2 class="text-4xl font-semibold">Hi {{$recipient->username}},</h2>

                    <p class="text-lg leading-relaxed m-4 text-gray-600">
                        {{$enquiry->name}} has requested for {{$enquiry->product_name}}
                        on your MyDLT platform, contact him/her now on {{$enquiry->phone}} and
                        follow him/her up with {{$enquiry->email}}.
                    </p>

                    <p class="text-lg leading-relaxed m-4 text-gray-600">
                        Make sure he/she did not just buy and leave,
                        turn him/her to your downlines on DLT-Health plus network.
                    </p>

                    <hr>

                    <h2 class="text-4xl font-semibold">Note from {{$enquiry->name}}:</h2>
                    <p class="text-lg leading-relaxed m-4 text-gray-600">
                        {!! $enquiry->message !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection

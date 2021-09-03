@extends('layouts.app')


@php

    $page_title = 'Settings';

    /** @var \App\Models\User $authUser */
    $authUser = auth()->user();
@endphp


@section('app-body')

    <div class="flex flex-wrap">

        @if(!$authUser->isMember())
            <div class="xl:w-1/3 mb-12 xl:mb-0 px-4">
                @livewire('settings.sms-rate-setting')

                <hr class="my-3">

                @livewire('settings.domain-rate-setting')

                <hr class="my-3">

                @livewire('settings.feature-video-url-setting')


            </div>
        @endif

        <div class="w-full xl:w-1/3 mb-12 xl:mb-0 px-4">
            @livewire('settings.user-profile-settings-form')
        </div>

        <div class="w-full xl:w-1/3 mb-12 xl:mb-0 px-4">
            @livewire('auth.change-password')
        </div>

            @if(!$authUser->isMember())
                <hr class="my-6 w-full">

                <div class="w-full xl:w-3/5 mb-12 xl:mb-0 px-4">
                    @livewire('settings.member-page-header-text')
                </div>

                <div class="w-full xl:w-2/5 mb-12 xl:mb-0 px-4">
                    @livewire('settings.photo-bg-setting')
                </div>
            @endif

    </div>


@endsection

@section('app-header')


@endsection

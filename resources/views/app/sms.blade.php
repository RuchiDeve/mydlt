@extends('layouts.app')

@php

    $page_title = 'SMS';
@endphp


@section('app-body')

    @livewire('sms-purchase-list')

    <hr class="my-8">

    @livewire('sms-usage-list')

@endsection

@section('app-header')


    <div>
        <!-- Card stats -->
        @include('partials.stats-card')
    </div>

@endsection

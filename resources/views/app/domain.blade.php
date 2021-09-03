@extends('layouts.app')



@php

    $page_title = 'Domain';

@endphp



@section('app-body')

    @livewire('domain-subscriptions')


@endsection

@section('app-header')


    <div>
        <!-- Card stats -->
        @include('partials.stats-card')
    </div>

@endsection

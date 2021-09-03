@extends('layouts.app')


@php

    $page_title = 'Enquiries';

@endphp



@section('app-body')

    @livewire('enquiry-list')

@endsection

@section('app-header')


    <div>
        <!-- Card stats -->
        @include('partials.stats-card')
    </div>

@endsection

@extends('layouts.app')


@php

    $page_title = 'Members';

@endphp



@section('app-body')

    @livewire('member-list')

@endsection

@section('app-header')


    <div>
        <!-- Card stats -->
        @include('partials.stats-card')
    </div>

@endsection

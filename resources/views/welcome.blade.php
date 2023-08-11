@section('title')
    Home
@endsection
@extends('frontend.layouts.main')
@section('content')
    {{-- carousel --}}
    <x-carousel class="mb-3"/>
    <div class="blogs">
        {{-- {{$posts}} --}}
        <x-categoryholder :posts="$posts" />
    </div>
@endsection
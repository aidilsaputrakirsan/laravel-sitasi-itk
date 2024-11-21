@extends('layouts.app')
@section('title', 'Sidang TA')
@section('style')
<link rel="stylesheet" href="{{ asset('dist/assets/css/timeline.css') }}">
@endsection

@section('content')
    @livewire('sidang-ta.show')
@endsection

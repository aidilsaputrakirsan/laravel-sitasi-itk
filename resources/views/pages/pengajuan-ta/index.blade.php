@extends('layouts.app')
@section('title', 'Pengajuan TA')
@section('style')
<link rel="stylesheet" href="{{ asset('dist/assets/css/timeline.css') }}">
@endsection

@section('content')
    @livewire('pengajuan-ta.show')
@endsection

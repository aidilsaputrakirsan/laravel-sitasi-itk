@extends('layouts.app')
@section('title', 'Seminar Proposal')
@section('style')
<link rel="stylesheet" href="{{ asset('dist/assets/css/timeline.css') }}">
@endsection

@section('content')
    @livewire('sempro.show')
@endsection

@extends('layouts.app')
@section('title', 'Jadwal Sempro')

@section('content')
    @livewire('jadwal.sempro.detail', ['periode_id' => $periode_id])
@endsection

@extends('layouts.app')
@section('title', 'Jadwal Sidang TA')

@section('content')
    @livewire('jadwal.sidang-ta.detail', ['periode_id' => $periode_id])
@endsection

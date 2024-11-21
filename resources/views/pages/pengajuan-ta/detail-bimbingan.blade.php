@extends('layouts.app')
@section('title', 'Detail Bimbingan')

@section('content')
    @livewire('pengajuan-ta.detail-bimbingan', ['id' => $id])
@endsection

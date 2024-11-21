@extends('layouts.app')
@section('title', 'List Mahasiswa')

@section('content')
    @livewire('periode.list-mahasiswa', ['id' => $id])
@endsection

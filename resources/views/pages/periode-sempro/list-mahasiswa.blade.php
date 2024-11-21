@extends('layouts.app')
@section('title', 'List Mahasiswa')

@section('content')
    @livewire('periode-sempro.list-mahasiswa', ['id' => $id])
@endsection

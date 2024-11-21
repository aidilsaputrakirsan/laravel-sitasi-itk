@extends('layouts.app')
@section('title', 'Bimbingan')

@section('style')
<!-- DataTables -->
<link href="{{ asset('dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dist/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @livewire('bimbingan.show')
@endsection

@section('script')
<!-- Required datatable js -->
<script src="{{ asset('dist/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dist/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('dist/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dist/assets/js/pages/datatable-pages.init.js')}}"></script>
@endsection

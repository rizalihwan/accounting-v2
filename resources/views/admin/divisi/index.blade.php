@extends('_layouts.main')
@section('title', 'Data Divisi')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.data-store') }}">Data Master</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Divisi</li>
@endpush
@section('content')
    
    @livewire('admin.divisi.data')
    
@endsection
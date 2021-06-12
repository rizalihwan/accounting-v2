@extends('_layouts.main')
@section('title', 'Subklasifikasi')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.ledger') }}">Jurnal</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Subklasifikasi</li>
@endpush
@section('content')
    
    @livewire('admin.subklasifikasi.data')
    
@endsection
@extends('_layouts.main')
@section('title', 'Akun')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.data-store') }}">Data Master</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Daftar Akun</li>
@endpush
@section('content')

    @livewire('admin.akun.data')

@endsection

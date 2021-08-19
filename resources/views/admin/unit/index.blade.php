@extends('_layouts.main')
@section('title', 'Data Unit')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.data-store') }}">Data Master</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Unit</li>
@endpush
@section('content')

    @livewire('admin.unit.data')

@endsection

@extends('_layouts.main')
@section('title', 'Data Category')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.data-store') }}">Data Master</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Kategori</li>
@endpush
@section('content')

    @livewire('admin.category.data')

@endsection

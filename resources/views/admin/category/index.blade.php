@extends('_layouts.main')
@section('title', 'Data Category')
@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.data-store') }}">Data Store</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Category</li>
@endpush
@section('content')
    
    @livewire('admin.category.data')
    
@endsection
@extends('_layouts.main')

@section('title', 'Laporan')
@push('breadcrumb')
<li class="breadcrumb-item active">Laporan</li>
@endpush
@section('content') 
<section id="card-content-types">
    <div class="row">
        <a href="{{ route('admin.report.keuangan.jurnalumum') }}">Jurnal Umum</a>
    </div>
</section>
@endsection

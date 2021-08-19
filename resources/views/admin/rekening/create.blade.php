@extends('_layouts.main')
@section('title', 'Data Rekening')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>Data</h5>
                            <span>Form Tambah Data Rekening</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="">Daftar Akun</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="">Tambah data Bank</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Tambah Data Rekening</h3>
                    </div>
                    <div class="card-body">
                        @livewire('admin.rekening.create-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

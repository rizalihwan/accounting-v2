@extends('_layouts.main')
@section('content')
@if(request()->routeIs('admin.data-store'))
    @section('title', 'Data Store')
    @push('breadcrumb')
        <li class="breadcrumb-item active">Data Store</li>
    @endpush
    <section id="card-content-types">
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <a href="{{ route('admin.category.index') }}">
                    <div class="card border-0 text-white shadow">
                        <img class="card-img" src="{{ asset('app-assets/images/slider/10.jpg') }}" alt="Category" />
                        <div class="card-img-overlay bg-overlay align-items-center d-flex justify-content-center">
                            <h1 class="card-text display-4 text-white font-weight-bold">Category</h1>
                            {{-- <p class="card-text">
                                This is a wider card with supporting text below as a natural lead-in to additional content. This content is
                                a little bit longer.
                            </p>
                            <p class="card-text">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </p> --}}
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card border-0 text-white shadow">
                    <img class="card-img" src="{{ asset('app-assets/images/slider/10.jpg') }}" alt="Unit" />
                    <div class="card-img-overlay bg-overlay align-items-center d-flex justify-content-center">
                        <h1 class="card-text display-4 text-white font-weight-bold">Unit</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card border-0 text-white shadow">
                    <img class="card-img" src="{{ asset('app-assets/images/slider/10.jpg') }}" alt="Product" />
                    <div class="card-img-overlay bg-overlay align-items-center d-flex justify-content-center">
                        <h1 class="card-text display-4 text-white font-weight-bold">Product</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(request()->routeIs('admin.ledger'))
        @section('title', 'Ledger')
        @push('breadcrumb')
            <li class="breadcrumb-item active">Ledger</li>
        @endpush
        {{--  --}}
    @endif

    @if(request()->routeIs('admin.sales'))
        @section('title', 'Sales')
        @push('breadcrumb')
            <li class="breadcrumb-item active">Sales</li>
        @endpush
        {{--  --}}
    @endif

    @if(request()->routeIs('admin.purchase'))
        @section('title', 'Purchases')
        @push('breadcrumb')
            <li class="breadcrumb-item active">Purchase</li>
        @endpush
        {{--  --}}
    @endif

    @if(request()->routeIs('admin.cash-bank'))
        @section('title', 'Cash & Bank')
        @push('breadcrumb')
            <li class="breadcrumb-item active">Cash & Bank</li>
        @endpush
        {{--  --}}
    @endif
    @if(request()->routeIs('admin.inventory'))
        @section('title', 'Inventory')
        @push('breadcrumb')
            <li class="breadcrumb-item active">Inventory</li>
        @endpush
        {{--  --}}
    @endif
    @if(request()->routeIs('admin.report'))
        @section('title', 'Report')
        @push('breadcrumb')
            <li class="breadcrumb-item active">Report</li>
        @endpush
        {{--  --}}
    @endif
@endsection

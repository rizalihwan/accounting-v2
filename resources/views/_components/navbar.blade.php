<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <span class="brand-logo">
                        <h1 class="text-dark" style="font-weight: bold;">
                            <img src="{{ asset('img/c.png') }}" alt="logo" class="mr-1" style="width: 38px; height: 58px; object-fit: contain">DIGKUAD
                        </h1>
                    </span>
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item">
                <a class="nav-link nav-link-style">
                    <i class="ficon" data-feather="moon"></i>
                </a>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name font-weight-bolder">{{ Str::upper(auth()->user()->name) }}</span>
                        <span class="user-status">{{ auth()->user()->role }}</span>
                    </div>
                    <span class="avatar">
                        @if (empty(auth()->user()->avatar))
                        <img class="round" src="{{ asset('img/avatar.png') }}" alt="avatar" height="40" width="40">
                        @else
                        <img class="round" src="{{ asset('storage/avatar/'. auth()->user()->avatar) }}" alt="avatar" height="40" width="40">
                        @endif
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ route('profile.setting') }}">
                        <i class="mr-50" data-feather="user"></i> Profile
                    </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void('logout')" onclick="logoutConfirm()">
                        <i class="mr-50" data-feather="power"></i> Keluar
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="mr-75" data-feather="alert-circle"></span><span>No results found.</span></div>
        </a></li>
</ul>
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<div class="horizontal-menu-wrapper">
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <span class="brand-logo">
                            <img src="{{ asset('img/c.png') }}" style="width: 40px; height: 30px" />
                        </span>
                        <h2 class="brand-text mb-0 text-dark">DIGKUAD</h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                        <i class="d-block d-xl-none text-dark toggle-icon font-medium-4" data-feather="x"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <!-- include ../../../includes/mixins-->
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('home') }}">
                        <i data-feather="home" class="text-danger"></i>
                        <span data-i18n="Dashboard">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/data-store*') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.data-store') }}">
                        <i data-feather="grid" class="text-danger"></i>
                        <span data-i18n="Data Store">Data Master</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/ledger*') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.ledger') }}">
                        <i data-feather="book-open" class="text-danger"></i>
                        <span data-i18n="Ledger">Jurnal</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/sales*') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.sales.') }}">
                        <i data-feather="shopping-cart" class="text-danger"></i>
                        <span data-i18n="Sales">Penjualan</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/purchase*') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.purchase.') }}">
                        <i data-feather="shopping-bag" class="text-danger"></i>
                        <span data-i18n="Purchase">Pembelian</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/cash-bank*') ? 'active' : '' }}{{ request()->is('admin/bkk') ? 'active' : '' }}{{ request()->is('admin/bkk/create') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.cash-bank') }}">
                        <i data-feather="credit-card" class="text-danger"></i>
                        <span data-i18n="Card & Bank">Kas & Bank</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/simpanpinjam*') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center" href="{{ route('admin.simpanpinjam') }}">
                    <i data-feather="box" class="text-danger"></i>
                    <span data-i18n="simpanpinjam">Simpan & Pinjam</span>
                </a>
                </li>
                <li class="nav-item {{ request()->is('admin/report*') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.report.menu') }}">
                        <i data-feather="file" class="text-danger"></i>
                        <span data-i18n="Report">Laporan</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- END: Main Menu-->

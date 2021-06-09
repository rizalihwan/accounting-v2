<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{ route('home') }}">
            <div class="logo-img">
               <h4>ACCOUNTING</h4>
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->segment(1);
        $segment2 = request()->segment(2);
    @endphp

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item @if(request()->routeIs('home')) active @endif">
                    <a href="{{ route('home') }}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>
                <div class="nav-item has-sub @if(request()->is('admin/category') || request()->is('admin/unit') || request()->is('admin/product')) active @endif">
                    <a href="#"><i class="ik ik-users"></i><span>{{ __('Data Master')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{ route('admin.category.index') }}" class="menu-item @if(request()->is('admin/category')) active @endif">{{ __('Category')}}</a>
                        <a href="{{ route('admin.unit.index') }}" class="menu-item @if(request()->is('admin/unit')) active @endif">{{ __('Unit')}}</a>
                        <a href="{{ route('admin.product.index') }}" class="menu-item @if(request()->is('admin/product')) active @endif">{{ __('Product')}}</a>
                    </div>
                </div>
                <div class="nav-item @if(request()->routeIs('admin.jurnalumum.index')) active @endif">
                    <a href="{{ route('admin.jurnalumum.index') }}"><i class="ik ik-book"></i><span>{{ __('Jurnal Umum')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>
                <div class="nav-item has-sub @if(request()->routeIs('admin.akun.index') || request()->routeIs('admin.subklasifikasi.index')) active @endif">
                    <a href="#"><i class="ik ik-users"></i><span>{{ __('Akun Management')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{ route('admin.akun.index') }}" class="menu-item @if(request()->routeIs('admin.akun.index')) active @endif">{{ __('Daftar Akun')}}</a>
                        <a href="{{ route('admin.subklasifikasi.index') }}" class="menu-item @if(request()->routeIs('admin.subklasifikasi.index')) active @endif">{{ __('Data Subklasifikasi')}}</a>
                    </div>
                </div>
                <div class="nav-item @if(request()->routeIs('admin.bukubesar.index')) active @endif">
                    <a href="{{ route('admin.bukubesar.index') }}"><i class="ik ik-book-open"></i><span>{{ __('Buku Besar')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>
                <div class="nav-item {{ ($segment1 == 'laporan laba rugi') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"><i class="ik ik-bookmark"></i><span>{{ __('Laporan Laba Rugi')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>
                <div class="nav-item has-sub @if(request()->routeIs('admin.bkm.create') || request()->routeIs('admin.bkk.index')) active @endif">
                    <a href="#"><i class="ik ik-book"></i><span>{{ __('Buku Kas')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{ route('admin.bkm.create') }}" class="menu-item @if(request()->routeIs('admin.bkm.create')) active @endif">{{ __('Buku Kas Masuk')}}</a>
                        <a href="{{ route('admin.bkk.index') }}" class="menu-item @if(request()->routeIs('admin.bkk.index')) active @endif">{{ __('Buku Kas Keluar')}}</a>
                    </div>
                </div>
                <div class="nav-item {{ ($segment1 == 'pembelian pembayaran') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"><i class="ik ik-plus"></i><span>{{ __('Pembelian Pembayaran')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>

                <div class="nav-item has-sub @if(request()->routeIs('admin.kontak.index') || request()->routeIs('admin.rekening.index') || request()->routeIs('admin.bank.index') || request()->routeIs('admin.divisi.index')) active @endif">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Bagan Akun (COA)')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{ route('admin.kontak.index') }}" class="menu-item @if(request()->routeIs('admin.kontak.index')) active @endif">{{ __('Data Kontak')}}</a>
                        <a href="{{ route('admin.rekening.index') }}" class="menu-item @if(request()->routeIs('admin.rekening.index')) active @endif">{{ __('Data Rekening')}}</a>
                        <a href="{{ route('admin.bank.index') }}" class="menu-item @if(request()->routeIs('admin.bank.index')) active @endif">{{ __('Data Bank')}}</a>
                        <a href="{{ route('admin.divisi.index') }}" class="menu-item @if(request()->routeIs('admin.divisi.index')) active @endif">{{ __('Data Divisi')}}</a>
                    </div>
                </div>

                <div class="nav-item {{ ($segment1 == 'neraca keuangan') ? 'active' : '' }}">
                    <a href=""><i class="ik ik-bar-chart-line-"></i><span>{{ __('Neraca Keuangan')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>
                <div class="nav-item {{ ($segment1 == 'pos') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"><i class="ik ik-dollar-sign"></i><span>{{ __('POS')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>
                <div class="nav-item {{ ($segment1 == 'penjualan penerimaan') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"><i class="ik ik-dollar-sign"></i><span>{{ __('Penjualan Penerimaan')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>
                <div class="nav-item {{ ($segment1 == 'simpan pinjam') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"><i class="ik ik-check-circle"></i><span>{{ __('Simpan Pinjam')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>
                <div class="nav-item has-sub">
                    <a href="#"><i class="ik ik-rotate-ccw"></i><span>{{ __('Backup Data')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('')}}" class="menu-item">{{ __('Backup Manual')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('Backup Otomatis')}}</a>
                    </div>
                </div>
                <div class="nav-item has-sub">
                    <a href="#"><i class="ik ik-edit"></i><span>{{ __('Management')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('')}}" class="menu-item">{{ __('User Management')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('Management Keanggotaan Koperasi')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('Inventory Management')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('Management Customer')}}</a>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="javascript:void(0)" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="text-danger">
                        <i class="ik ik-log-out text-danger"></i>
                        <span>{{ __('Logout')}}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

        </div>
    </div>
</div>

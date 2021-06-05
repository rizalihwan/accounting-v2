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
                <div class="nav-item {{ ($segment1 == 'dashboard') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>
                <div class="nav-item {{ ($segment1 == 'jurnal umum') ? 'active' : '' }}">
                    <a href="{{ route('admin.jurnalumum.index') }}"><i class="ik ik-book"></i><span>{{ __('Jurnal Umum')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>
                <div class="nav-item {{ ($segment1 == 'buku besar') ? 'active' : '' }}">
                    <a href="{{ route('admin.bukubesar.index') }}"><i class="ik ik-book-open"></i><span>{{ __('Buku Besar')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>
                <div class="nav-item {{ ($segment1 == 'laporan laba rugi') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"><i class="ik ik-bookmark"></i><span>{{ __('Laporan Laba Rugi')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>
                <div class="nav-item has-sub">
                    <a href="#"><i class="ik ik-book"></i><span>{{ __('Buku Kas')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{ route('admin.bkm.create') }}" class="menu-item">{{ __('Buku Kas Masuk')}}</a>
                        <a href="{{ route('admin.bkk.index') }}" class="menu-item">{{ __('Buku Kas Keluar')}}</a>
                    </div>
                </div>
                <div class="nav-item {{ ($segment1 == 'pembelian pembayaran') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"><i class="ik ik-plus"></i><span>{{ __('Pembelian Pembayaran')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>

                <div class="nav-item has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Bagan Akun (COA)')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('')}}" class="menu-item">{{ __('Data Rekening')}}</a>
                        <a href="{{ route('admin.bank.index') }}" class="menu-item">{{ __('Data Bank')}}</a>
                        <a href="{{ route('admin.divisi.index') }}" class="menu-item">{{ __('Data Divisi')}}</a>
                    </div>
                </div>

                <div class="nav-item {{ ($segment1 == 'neraca keuangan') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"><i class="ik ik-bar-chart-line-"></i><span>{{ __('Neraca Keuangan')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
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
                    <a href="javascript:void(0)" class="disabled"><i class="ik ik-slash"></i><span>{{ __('Disabled Menu')}}</span></a>
                </div>

        </div>
    </div>
</div>

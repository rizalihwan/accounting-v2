<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="home">
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
                    <a href="home"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span>{{--<span class="badge badge-danger">{{ __('150+')}}</span>--}}</a>
                </div>
                <div class="nav-item has-sub">
                    <a href="#"><i class="ik ik-edit"></i><span>{{ __('Transaksi')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('#')}}" class="menu-item">{{ __('1. Bukti Kas Masuk - BKM')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('2. Bukti Kas Keluar - BKK')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('3. Jurnal Umum')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('4. Cek/Giro')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('5. Rekonsilasi Bank')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('6. Template Jurnal')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('7. Revaluasi Valuta Asing')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('8. Jurnal Penyesuaian')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('9. Saldo Awal Periode')}}</a>
                    </div>
                </div>
                <div class="nav-item has-sub">
                    <a href="#"><i class="ik ik-edit"></i><span>{{ __('Data-data')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('#')}}" class="menu-item">{{ __('1. Data Transaksi')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('2. Data Transaksi - Hutang')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('3. Data Transaksi - Piutang')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('4. Saldo AR/AP Per Kontak')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('5. Saldo Hutang Per Kontak')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('6. Saldo Piutang Per Kontak')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('7. Data Rekening')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('8. Data Kontak Person')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('9. Data Mata Uang Dari Kurs')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('10. Data Bank')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('11. Divisi/Proyek')}}</a>
                    </div>
                </div>
                <div class="nav-item has-sub">
                    <a href="#"><i class="ik ik-edit"></i><span>{{ __('Administrator')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('#')}}" class="menu-item">{{ __('1. Administrasi User')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('2. Sinkronisasi Database (Online)')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('3. Posting Transaksi')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('4. Reaktif Cek/Giro')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('5. Utility Administrator')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('6. Tutup Buku - Akhir Bulan')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('7. Tutup Buku - Akhir Tahun')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('8. Setting Data Perusahaan')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('9. Setting Alfacurrency')}}</a>
                    </div>
                </div>
                <div class="nav-item has-sub">
                    <a href="#"><i class="ik ik-edit"></i><span>{{ __('Utility')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('#')}}" class="menu-item">{{ __('1. Tampilkan Reminder/Pengingat')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('2. Setting Data User')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('3. Setting - Regional')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('4. Kalkulasi Mata Uang')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('5. Berita (Online)')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('6. Pencarian Transaksi')}}</a>
                        <a href="{{url('')}}" class="menu-item">{{ __('7. History Kurs')}}</a>
                    </div>
                </div>
                <div class="nav-item has-sub">
                    <a href="#"><i class="ik ik-edit"></i><span>{{ __('Laporan')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('#')}}" class="menu-item">{{ __('1. Statistik Data')}}</a>

                        <div class="nav-item has-sub">
                            <a href="#" class="menu-item"><span>{{ __('2. Laporan Jurnal')}}</span></a>
                            <div class="submenu-content">
                                <a href="{{url('#')}}" class="menu-item">{{ __('1. Bukti Kas Masuk')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('2. Bukti Kas Keluar')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('3. Jurnal Umum')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('4. Giro Masuk')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('5. Giro Keluar')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('6. Umur Giro Masuk')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('7. Umur Giro Keluar')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('8. Umur Hutang')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('9. Umur Piutang')}}</a>
                            </div>
                        </div>

                        <div class="nav-item has-sub">
                            <a href="#" class="menu-item"><span>{{ __('3. Laporan Keuangan')}}</span></a>
                            <div class="submenu-content">
                                <a href="{{url('#')}}" class="menu-item">{{ __('1. Neraca')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('2. Rugi/Laba')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('3. Neraca Lajur')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('4. Transaksi')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('5. Transaksi (Valas)')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('6. Transaksi - Jurnal')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('7. Rekonsiliasi Bank')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('8. Hutang/Piutang per Kontak')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('9. Anggaran dan Realisasi')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('10. Ringkasan Transaksi')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('11. Neraca2')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('12. Rugi/Laba Akumulatif')}}</a>
                            </div>
                        </div>

                        <div class="nav-item has-sub">
                            <a href="#" class="menu-item"><span>{{ __('4. Laporan Lain-lain')}}</span></a>
                            <div class="submenu-content">
                                <a href="{{url('#')}}" class="menu-item">{{ __('1. Daftar Rekening')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('2. Daftar Kontak')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('3. Daftar Bank')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('4. Mata Uang')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('5. Label Kontak')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('6. R/L Per Divisi/Proyek')}}</a>
                            </div>
                        </div>

                        <div class="nav-item has-sub">
                            <a href="#" class="menu-item"><span>{{ __('5. Laporan Perbandingan')}}</span></a>
                            <div class="submenu-content">
                                <a href="{{url('#')}}" class="menu-item">{{ __('1. Neraca (Anggaran vs Realisasi')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('2. R/L (Anggaran vs Realisasi')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('3. Neraca Bulan ini vs Bulan Lalu (1)')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('4. Neraca Bulan ini vs Bulan Lalu (2)')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('5. Neraca Bulan ini vs Bulan Lalu (3)')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('6. R/L Bulan ini vs Kemarin')}}</a>
                                <a href="{{url('#')}}" class="menu-item">{{ __('6. R/L Per Kontak Per Bulan')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="javascript:void(0)" class="disabled"><i class="ik ik-slash"></i><span>{{ __('Disabled Menu')}}</span></a>
                </div>

        </div>
    </div>
</div>

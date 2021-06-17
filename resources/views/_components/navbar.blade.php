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
            {{-- <ul class="nav navbar-nav bookmark-icons">
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-email.html" data-toggle="tooltip" data-placement="top" title="Email"><i class="ficon" data-feather="mail"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html" data-toggle="tooltip" data-placement="top" title="Chat"><i class="ficon" data-feather="message-square"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-calendar.html" data-toggle="tooltip" data-placement="top" title="Calendar"><i class="ficon" data-feather="calendar"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-todo.html" data-toggle="tooltip" data-placement="top" title="Todo"><i class="ficon" data-feather="check-square"></i></a></li>
            </ul> --}}
            {{-- <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon text-warning" data-feather="star"></i></a>
                    <div class="bookmark-input search-input">
                        <div class="bookmark-input-icon"><i data-feather="search"></i></div>
                        <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
                        <ul class="search-list search-list-bookmark"></ul>
                    </div>
                </li>
            </ul> --}}
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            {{-- <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="javascript:void(0);" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="javascript:void(0);" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="javascript:void(0);" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a><a class="dropdown-item" href="javascript:void(0);" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a></div>
            </li> --}}
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
            {{-- <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li> --}}
            {{-- <li class="nav-item dropdown dropdown-cart mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="shopping-cart"></i><span class="badge badge-pill badge-primary badge-up cart-item-count">6</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">My Cart</h4>
                            <div class="badge badge-pill badge-light-primary">4 Items</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        <div class="media align-items-center"><img class="d-block rounded mr-1" src="{{ asset('app-assets/images/pages/eCommerce/1.png') }}" alt="donuts" width="62">
            <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>
                <div class="media-heading">
                    <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> Apple watch 5</a></h6><small class="cart-item-by">By Apple</small>
                </div>
                <div class="cart-item-qty">
                    <div class="input-group">
                        <input class="touchspin-cart" type="number" value="1">
                    </div>
                </div>
                <h5 class="cart-item-price">$374.90</h5>
            </div>
    </div>
    <div class="media align-items-center"><img class="d-block rounded mr-1" src="{{ asset('app-assets/images/pages/eCommerce/7.png') }}" alt="donuts" width="62">
        <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>
            <div class="media-heading">
                <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> Google Home Mini</a></h6><small class="cart-item-by">By Google</small>
            </div>
            <div class="cart-item-qty">
                <div class="input-group">
                    <input class="touchspin-cart" type="number" value="3">
                </div>
            </div>
            <h5 class="cart-item-price">$129.40</h5>
        </div>
    </div>
    <div class="media align-items-center"><img class="d-block rounded mr-1" src="{{ asset('app-assets/images/pages/eCommerce/2.png') }}" alt="donuts" width="62">
        <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>
            <div class="media-heading">
                <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> iPhone 11 Pro</a></h6><small class="cart-item-by">By Apple</small>
            </div>
            <div class="cart-item-qty">
                <div class="input-group">
                    <input class="touchspin-cart" type="number" value="2">
                </div>
            </div>
            <h5 class="cart-item-price">$699.00</h5>
        </div>
    </div>
    <div class="media align-items-center"><img class="d-block rounded mr-1" src="{{ asset('app-assets/images/pages/eCommerce/3.png') }}" alt="donuts" width="62">
        <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>
            <div class="media-heading">
                <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> iMac Pro</a></h6><small class="cart-item-by">By Apple</small>
            </div>
            <div class="cart-item-qty">
                <div class="input-group">
                    <input class="touchspin-cart" type="number" value="1">
                </div>
            </div>
            <h5 class="cart-item-price">$4,999.00</h5>
        </div>
    </div>
    <div class="media align-items-center"><img class="d-block rounded mr-1" src="{{ asset('app-assets/images/pages/eCommerce/5.png') }}" alt="donuts" width="62">
        <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>
            <div class="media-heading">
                <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> MacBook Pro</a></h6><small class="cart-item-by">By Apple</small>
            </div>
            <div class="cart-item-qty">
                <div class="input-group">
                    <input class="touchspin-cart" type="number" value="1">
                </div>
            </div>
            <h5 class="cart-item-price">$2,999.00</h5>
        </div>
    </div>
    </li>
    <li class="dropdown-menu-footer">
        <div class="d-flex justify-content-between mb-1">
            <h6 class="font-weight-bolder mb-0">Total:</h6>
            <h6 class="text-primary font-weight-bolder mb-0">$10,999.00</h6>
        </div><a class="btn btn-primary btn-block" href="app-ecommerce-checkout.html">Checkout</a>
    </li>
    </ul>
    </li>
    <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up">5</span></a>
        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
            <li class="dropdown-menu-header">
                <div class="dropdown-header d-flex">
                    <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                    <div class="badge badge-pill badge-light-primary">6 New</div>
                </div>
            </li>
            <li class="scrollable-container media-list"><a class="d-flex" href="javascript:void(0)">
                    <div class="media d-flex align-items-start">
                        <div class="media-left">
                            <div class="avatar"><img src="{{ asset('app-assets/images/portrait/small/avatar-s-15.jpg') }}" alt="avatar" width="32" height="32"></div>
                        </div>
                        <div class="media-body">
                            <p class="media-heading"><span class="font-weight-bolder">Congratulation Sam 🎉</span>winner!</p><small class="notification-text"> Won the monthly best seller badge.</small>
                        </div>
                    </div>
                </a><a class="d-flex" href="javascript:void(0)">
                    <div class="media d-flex align-items-start">
                        <div class="media-left">
                            <div class="avatar"><img src="{{ asset('app-assets/images/portrait/small/avatar-s-3.jpg') }}" alt="avatar" width="32" height="32"></div>
                        </div>
                        <div class="media-body">
                            <p class="media-heading"><span class="font-weight-bolder">New message</span>&nbsp;received</p><small class="notification-text"> You have 10 unread messages</small>
                        </div>
                    </div>
                </a><a class="d-flex" href="javascript:void(0)">
                    <div class="media d-flex align-items-start">
                        <div class="media-left">
                            <div class="avatar bg-light-danger">
                                <div class="avatar-content">MD</div>
                            </div>
                        </div>
                        <div class="media-body">
                            <p class="media-heading"><span class="font-weight-bolder">Revised Order 👋</span>&nbsp;checkout</p><small class="notification-text"> MD Inc. order updated</small>
                        </div>
                    </div>
                </a>
                <div class="media d-flex align-items-center">
                    <h6 class="font-weight-bolder mr-auto mb-0">System Notifications</h6>
                    <div class="custom-control custom-control-primary custom-switch">
                        <input class="custom-control-input" id="systemNotification" type="checkbox" checked="">
                        <label class="custom-control-label" for="systemNotification"></label>
                    </div>
                </div><a class="d-flex" href="javascript:void(0)">
                    <div class="media d-flex align-items-start">
                        <div class="media-left">
                            <div class="avatar bg-light-danger">
                                <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                            </div>
                        </div>
                        <div class="media-body">
                            <p class="media-heading"><span class="font-weight-bolder">Server down</span>&nbsp;registered</p><small class="notification-text"> USA Server is down due to hight CPU usage</small>
                        </div>
                    </div>
                </a><a class="d-flex" href="javascript:void(0)">
                    <div class="media d-flex align-items-start">
                        <div class="media-left">
                            <div class="avatar bg-light-success">
                                <div class="avatar-content"><i class="avatar-icon" data-feather="check"></i></div>
                            </div>
                        </div>
                        <div class="media-body">
                            <p class="media-heading"><span class="font-weight-bolder">Sales report</span>&nbsp;generated</p><small class="notification-text"> Last month sales report generated</small>
                        </div>
                    </div>
                </a><a class="d-flex" href="javascript:void(0)">
                    <div class="media d-flex align-items-start">
                        <div class="media-left">
                            <div class="avatar bg-light-warning">
                                <div class="avatar-content"><i class="avatar-icon" data-feather="alert-triangle"></i></div>
                            </div>
                        </div>
                        <div class="media-body">
                            <p class="media-heading"><span class="font-weight-bolder">High memory</span>&nbsp;usage</p><small class="notification-text"> BLR Server using high memory</small>
                        </div>
                    </div>
                </a>
            </li>
            <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="javascript:void(0)">Read all notifications</a></li>
        </ul>
    </li> --}}
    <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <a class="dropdown-item" href="javascript:void('logout')" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="mr-50" data-feather="power"></i> Logout
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
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('home') }}">
                        <span class="brand-logo">
                            <img src="{{ asset('img/c.png') }}" style="width: 40px; height: 30px" />
                        </span>
                        <h2 class="brand-text mb-0 text-warning">Digkuad</h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-warning toggle-icon font-medium-4" data-feather="x"></i></a></li>
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
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.sales') }}">
                        <i data-feather="shopping-cart" class="text-danger"></i>
                        <span data-i18n="Sales">Penjualan</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/purchase*') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.purchase') }}">
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
                {{-- <li class="nav-item {{ request()->is('admin/inventory*') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center" href="{{ route('admin.inventory') }}">
                    <i data-feather="box" class="text-danger"></i>
                    <span data-i18n="Inventory">Persediaan Barang</span>
                </a>
                </li> --}}
                <li class="nav-item {{ request()->is('admin/report*') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.report') }}">
                        <i data-feather="file" class="text-danger"></i>
                        <span data-i18n="Report">Report</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- END: Main Menu-->

@extends('_layouts.main')
@section('title', 'Dashboard')
@section('content')
    <!-- push external head elements to head -->
    @push('head')

        <link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
    @endpush

    <div class="container-fluid">
    	<div class="row">
    		<!-- page statustic chart start -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-red text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __('2,563')}}</h4>
                                <p class="mb-0">{{ __('Products')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fas fa-cube f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart1" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-blue text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __('3,612')}}</h4>
                                <p class="mb-0">{{ __('Orders')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-shopping-cart f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart2" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-green text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __('865')}}</h4>
                                <p class="mb-0">{{ __('Customers')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-user f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart3" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __('35,500')}}</h4>
                                <p class="mb-0">{{ __('Sales')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik f-30">৳</i>
                            </div>
                        </div>
                        <div id="Widget-line-chart4" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div>
            <!-- page statustic chart end -->
            <!-- sale 2 card start -->
            <div class="col-md-6 col-xl-4">
                <div class="card sale-card">
                    <div class="card-header">
                        <h3>{{ __('Realtime Profit')}}</h3>
                    </div>
                    <div class="card-block text-center">
                        <div id="realtime-profit"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card sale-card">
                    <div class="card-header">
                        <h3>{{ __('Sales Difference')}}</h3>
                    </div>
                    <div class="card-block text-center">
                        <div id="sale-diff" class="chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card card-green text-white">
                    <div class="card-block pb-0">
                        <div class="row mb-50">
                            <div class="col">
                                <h6 class="mb-5">{{ __('Sales In July')}}</h6>
                                <h5 class="mb-0  fw-700">{{ __('$2665.00')}}</h5>
                            </div>
                            <div class="col-auto text-center">
                                <p class="mb-5">{{ __('Direct Sale')}}</p>
                                <h6 class="mb-0">{{ __('$1768')}}</h6>
                            </div>

                            <div class="col-auto text-center">
                                <p class="mb-5">{{ __('Referal')}}</p>
                                <h6 class="mb-0">{{ __('$897')}}</h6>
                            </div>
                        </div>
                        <div id="sec-ecommerce-chart-line" class="chart-shadow"></div>
                        <div id="sec-ecommerce-chart-bar" ></div>
                    </div>
                </div>
            </div>
            <!-- sale 2 card end -->

            <!-- product and new customar start -->
            <div class="col-xl-4 col-md-6">
                <div class="card new-cust-card">
                    <div class="card-header">
                        <h3>{{ __('New Customers')}}</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="align-middle mb-25">
                            <img src="../img/users/1.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                            <div class="d-inline-block">
                                <a href="#!"><h6>{{ __('Alex Thompson')}}</h6></a>
                                <p class="text-muted mb-0">{{ __('Cheers!')}}</p>
                                <span class="status active"></span>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <img src="../img/users/2.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                            <div class="d-inline-block">
                                <a href="#!"><h6>{{ __('John Doue')}}</h6></a>
                                <p class="text-muted mb-0">{{ __('stay hungry stay foolish!')}}</p>
                                <span class="status active"></span>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <img src="../img/users/3.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                            <div class="d-inline-block">
                                <a href="#!"><h6>{{ __('Alex Thompson')}}</h6></a>
                                <p class="text-muted mb-0">{{ __('Cheers!')}}</p>
                                <span class="status deactive text-mute"><i class="far fa-clock mr-10"></i>{{ __('30 min ago')}}</span>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <img src="../img/users/4.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                            <div class="d-inline-block">
                                <a href="#!"><h6>{{ __('John Doue')}}</h6></a>
                                <p class="text-muted mb-0">{{ __('Cheers!')}}</p>
                                <span class="status deactive text-mute"><i class="far fa-clock mr-10"></i>{{ __('10 min ago')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-6">
                <div class="card table-card">
                    <div class="card-header">
                        <h3>{{ __('New Products')}}</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Product Name')}}</th>
                                        <th>{{ __('Image')}}</th>
                                        <th>{{ __('Status')}}</th>
                                        <th>{{ __('Price')}}</th>
                                        <th>{{ __('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ __('HeadPhone')}}</td>
                                        <td><img src="../img/widget/p1.jpg" alt="" class="img-fluid img-20"></td>
                                        <td>
                                            <div class="p-status bg-green"></div>
                                        </td>
                                        <td>{{ __('$10')}}</td>
                                        <td>
                                            <a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                            <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Iphone 6')}}</td>
                                        <td><img src="../img/widget/p2.jpg" alt="" class="img-fluid img-20"></td>
                                        <td>
                                            <div class="p-status bg-green"></div>
                                        </td>
                                        <td>{{ __('$2')}}0</td>
                                        <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Jacket')}}</td>
                                        <td><img src="../img/widget/p3.jpg" alt="" class="img-fluid img-20"></td>
                                        <td>
                                            <div class="p-status bg-green"></div>
                                        </td>
                                        <td>{{ __('$35')}}</td>
                                        <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Sofa')}}</td>
                                        <td><img src="../img/widget/p4.jpg" alt="" class="img-fluid img-20"></td>
                                        <td>
                                            <div class="p-status bg-green"></div>
                                        </td>
                                        <td>{{ __('$85')}}</td>
                                        <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Iphone 6')}}</td>
                                        <td><img src="../img/widget/p2.jpg" alt="" class="img-fluid img-20"></td>
                                        <td>
                                            <div class="p-status bg-green"></div>
                                        </td>
                                        <td>{{ __('$20')}}</td>
                                        <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- product and new customar end -->
            <!-- Application Sales start -->
            <div class="col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h3>{{ __('Application Sales')}}</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block p-b-0">
                        <div class="table-responsive scroll-widget">
                            <table class="table table-hover table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Application')}}</th>
                                        <th>{{ __('Sales')}}</th>
                                        <th>{{ __('Change')}}</th>
                                        <th>{{ __('Avg Price')}}</th>
                                        <th>{{ __('Total')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <h6>{{ __('Able Pro')}}</h6>
                                                <p class="text-muted mb-0">{{ __('Powerful Admin Theme')}}</p>
                                            </div>
                                        </td>
                                        <td>{{ __('16,300')}}</td>
                                        <td>
                                            <div id="app-sale1"></div>
                                        </td>
                                        <td>$53</td>
                                        <td class="text-blue">{{ __('$15,652')}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <h6>{{ __('Photoshop')}}</h6>
                                                <p class="text-muted mb-0">{{ __('Design Software')}}</p>
                                            </div>
                                        </td>
                                        <td>{{ __('26,421')}}</td>
                                        <td>
                                            <div id="app-sale2"></div>
                                        </td>
                                        <td>{{ __('$35')}}</td>
                                        <td class="text-blue">{{ __('$18,785')}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <h6>{{ __('Guruable')}}</h6>
                                                <p class="text-muted mb-0">{{ __('Best Admin Template')}}</p>
                                            </div>
                                        </td>
                                        <td>{{ __('8,265')}}</td>
                                        <td>
                                            <div id="app-sale3"></div>
                                        </td>
                                        <td>{{ __('$98')}}</td>
                                        <td class="text-blue">{{ __('$9,652')}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <h6>{{ __('Flatable')}}</h6>
                                                <p class="text-muted mb-0">{{ __('Admin App')}}</p>
                                            </div>
                                        </td>
                                        <td>{{ __('10,652')}}</td>
                                        <td>
                                            <div id="app-sale4"></div>
                                        </td>
                                        <td>{{ __('$20')}}</td>
                                        <td class="text-blue">{{ __('$7,856')}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <a href="#!" class=" b-b-primary text-primary">{{ __('View all Projects')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Application Sales end -->
    	</div>
    </div>
	<!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/owl.carousel/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('plugins/chartist/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>
        <!-- <script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js') }}"></script> -->
        <script src="{{ asset('plugins/flot-charts/curvedLines.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>

        <script src="{{ asset('plugins/amcharts/amcharts.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/serial.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/themes/light.js') }}"></script>


        <script src="{{ asset('js/widget-statistic.js') }}"></script>
        <script src="{{ asset('js/widget-data.js') }}"></script>
        <script src="{{ asset('js/dashboard-charts.js') }}"></script>

    @endpush
@endsection

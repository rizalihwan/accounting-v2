<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
	<title>@yield('title','') | Accounting</title>
	<!-- initiate head with meta tags, css and script -->
	@include('_include.head')

</head>
<body id="app" >
    <div class="wrapper">
    	<!-- initiate header-->
    	@include('_include.header')
    	<div class="page-wrap">
	    	<!-- initiate sidebar-->
	    	@include('_include.sidebar')

	    	<div class="main-content">
	    		<!-- yeild contents here -->
	    		@yield('content')
	    	</div>

	    	<!-- initiate chat section-->
	    	@include('_include.chat')


	    	<!-- initiate footer section-->
	    	@include('_include.footer')

    	</div>
    </div>

	<!-- initiate modal menu section-->
	@include('_include.modalmenu')

	<!-- initiate scripts-->
	@include('_include.script')
</body>
</html>

	<head><base href="../../../"/>
		<title>@yield('title')</title>
		@csrf
		<meta charset="utf-8" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="" />
		<meta property="og:url" content="" />
		<meta property="og:site_name" content="" />
		<link rel="canonical" href="" />
		<link rel="shortcut icon" href="{{url('storage/site')}}/{{$settings->favicon_img_path}}" />
		<link rel="icon" type="image/x-icon" href="{{url('storage/site')}}/{{$settings->favicon_img_path}}">

		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->


		<link href="{{global_asset('assets/css/intlTelInput.css?v=1')}}" rel="stylesheet" type="text/css" />
		<link href="{{global_asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{global_asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{global_asset('assets/css/lightboxed.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{global_asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{global_asset('assets/css/style.css?v=')}}{{time()}}" rel="stylesheet" type="text/css" />

		<!--end::Global Stylesheets Bundle-->
	</head>
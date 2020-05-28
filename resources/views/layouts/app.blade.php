<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<base href="../../../">
		<meta charset="utf-8" />
		@yield('page-title')
		<meta name="description" content="Login page example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Updates and statistics">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
        <!--end::Fonts -->
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/pages/login/login.css') }}" rel="stylesheet" type="text/css" >
		@yield('page-css')
		<link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed">

    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
                <!--begin::Aside-->
                <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url(/assets/media/bg/bg-4.jpg);">

                    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                        <div class="kt-grid__item kt-grid__item--middle">
                            <h3 class="kt-login__title">

                            </h3>

                        </div>
                    </div>
                    <div class="kt-grid__item">
                        <div class="kt-login__info">
                            <div class="kt-login__copyright">
                                © 2020 DATA MANAGER
                            </div>

                        </div>
                    </div>
                </div>
                <!--begin::Aside-->

                <!--begin::Content-->
                <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
                    <!--begin::Head-->

                    <!--end::Head-->

                   @yield('page-content')
                </div>
                <!--end::Content-->
            </div>
        </div>
    </div>

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};
        </script>
		<script src="{{ asset('js/app.js') }}"></script>
		@yield('page-js')
		<!--begin::Page Scripts(used by this page) -->
        <!-- <script src="{{ asset('js/pages/login/login-general.js') }}"></script> -->
		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>
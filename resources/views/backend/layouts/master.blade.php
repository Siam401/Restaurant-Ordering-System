<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title>Resturant Ordering System</title>


<!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
	<meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
	<meta name="author" content="colorlib" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="icon" href="https://colorlib.com//polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/bower_components/bootstrap/css/bootstrap.min.css') }}">

<link rel="stylesheet" href="{{ asset('ui/backend/files/assets/pages/waves/css/waves.min.css') }}" type="text/css" media="all">

<link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/icon/feather/css/feather.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/icon/themify-icons/themify-icons.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/icon/icofont/css/icofont.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/icon/font-awesome/css/font-awesome.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/css/pages.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/css/multiselect/multi-select.css') }}">
@yield('css')
</head>
<body>

	<div class="loader-bg">
		<div class="loader-bar"></div>
	</div>

	<div id="pcoded" class="pcoded">
		<div class="pcoded-overlay-box"></div>
		<div class="pcoded-container navbar-wrapper">

			@include('backend.layouts.partials.header')

			<div class="pcoded-main-container">
				<div class="pcoded-wrapper">

					@include('backend.layouts.partials.sidebar')

					<div class="pcoded-content">

                        @yield('content')
                        
					</div>

					<div id="styleSelector">
					</div>

				</div>
			</div>
		</div>
	</div>


<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/jquery/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('ui/backend/files/assets/pages/waves/js/waves.min.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>

<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/modernizr/js/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/modernizr/js/css-scrollbars.js') }}"></script>

<script src="{{ asset('ui/backend/files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/backend/files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/backend/files/assets/pages/data-table/js/jszip.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/backend/files/assets/pages/data-table/js/pdfmake.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/backend/files/assets/pages/data-table/js/vfs_fonts.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/backend/files/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/backend/files/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/backend/files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/backend/files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/backend/files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('ui/backend/files/assets/pages/data-table/js/data-table-custom.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/backend/files/assets/js/pcoded.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/backend/files/assets/js/vertical/vertical-layout.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ui/backend/files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('ui/backend/files/assets/js/script.js') }}"></script>
<script src="{{ asset('ui/backend/files/assets/js/select2/jquery.multi-select.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.18.6/dist/sweetalert2.all.min.js"></script>
@yield('script')
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="text/javascript"></script>

<script type="text/javascript">
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-23581568-13');
</script>
<script>
		function sweetalert(){
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				if (result.value) {
					Swal.fire(
					'Deleted!',
					'Your file has been deleted.',
					'success'
					)
				}
			})
		}
	</script>
<script src="{{ asset('ui/backend/ajax.cloudflare.com/cdn-cgi/scripts/95c75768/cloudflare-static/rocket-loader.min.js') }}" data-cf-settings="|49" defer=""></script></body>




</html>

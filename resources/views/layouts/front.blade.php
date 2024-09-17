<!doctype html>
<html lang="en">
	<head>
		<title>@yield('title') - SIMJAKIDA</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/kaltara.css') }}">
		<link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">

		{{-- fonts --}}
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@400;700;900&display=swap" rel="stylesheet">

		{{-- font awesome --}}
		<script src="https://kit.fontawesome.com/37c5adffc7.js" crossorigin="anonymous"></script>

		{{-- css stack --}}
		@stack('css')
	</head>
	<body>
		<div class="container-fluid">
			<header>
				{{-- start header --}}
				@include('layouts.partials.header')
				{{-- end header --}}
			</header>

			{{-- content --}}
			<div class="row">
				<div class="col-md-10 offset-md-1 pl-lg-4">
					@include('flashalert')
					@yield('content')
				</div>
			</div>

			{{-- footer --}}
			@include('layouts.partials.footer')
		</div>
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
		<script src="{{ asset('js/popper.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		
		{{-- jquery setup for ajax --}}
		<script type="text/javascript">
			var baseURL = {!! json_encode(url('/')) !!};	//getting base url
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		</script>

		{{-- javascript stack --}}
		<script src="{{ asset('js/front.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/collect.js/4.34.3/collect.min.js"></script>
		@stack('js')
	</body>
</html>
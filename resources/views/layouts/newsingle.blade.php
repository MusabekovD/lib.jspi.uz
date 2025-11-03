<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ config('app.name', 'Laravel') }}</title>
	<link rel="stylesheet" href="{{ asset('/newassets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('/newassets/css/main.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}
{{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>--}}
{{--    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />--}}
</head>
<body>
	<header>
		@include('widgets.newheader')
	</header>
	<div class="body">

		<section class="main_news" style="padding: 50px 0;" >
			<div class="container">
                @yield('newcontent')
			</div>
		</section>

		<footer>
			@include('frontend.footermenu')
		</footer>
		<div class="footer"></div>

	</div><!-- end body  -->
	<div class="footer"></div>
	<!-- <script src="js/bootstrap.min.js"></script> -->
	<script src="{{ asset('newassets/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>

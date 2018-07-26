<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
	
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				{!! Form::open([ 'route' => 'changeLanguage', 'method' => 'put']) !!}
					{!! Form::select('lang', 
						['vi' => 'Vietnamese', 'en' => 'English'], 
						session('lang'), 
						[
							'class' => 'custom-select mt-4',
							'id' => 'lang'
						])
					!!}
				{!! Form::close() !!}
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<a class="navbar-brand" href="#">Task Manager</a>
				</nav>
				@yield('content')

			</div>
		</div>
	</div>
	@section('js')
		<script src="{{asset('js/jquery.min.js')}}"></script>
		<script>
			console.log('x');
			$(document).ready(function(){
				$('#lang').change(function(){
					$(this).parent('form').submit();
				});
			});
		</script>
	@show
</body>
</html>

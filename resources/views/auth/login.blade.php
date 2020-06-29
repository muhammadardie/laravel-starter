<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<!--begin::Base Path (base relative path for assets of this page) -->
		<base href="{{ asset('') }}">

		<!--end::Base Path -->
		<meta charset="utf-8" />
		<title>Laravel Starter</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">

        <!--   Core JS Files   -->
	    <script src="assets/js/core/jquery.3.2.1.min.js"></script>
	    <script src="assets/js/core/popper.min.js"></script>
	    <script src="assets/js/core/bootstrap.min.js"></script>

    	<!-- CSS Files -->
    	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
    	<link href="assets/css/login.css" rel="stylesheet" type="text/css" />
    	
	</head>    
	<body>
		<div class="login">
			<h1>Laravel Starter</h1>
		    <form id="login-form" role="form" class="kt-form" action="{{ route('login') }}" method="post">
		        {{ csrf_field() }}
		    	<input type="email" placeholder="Email" name="email" required/>
		        <input type="password" placeholder="Password" name="password" required>
		        @if ($errors->any())
                    <span class="help-block" style="color:red">
                        <strong>@lang('auth.failed')</strong>
                    </span>
                @endif
		        <button type="submit" class="btn btn-primary btn-block btn-large">LOGIN</button>
		    </form>
		</div>
	</body>
</html>
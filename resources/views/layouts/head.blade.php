<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js" prefix="og: http://ogp.me/ns#">
<!--<![endif]-->
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"/>

	<title>Matrimonial App</title>

	<link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/app.css') }}?v=1.13" />
</head>

<body class="@yield('body-class')" data-spy="scroll" data-target="#mainNav"> 	
	@yield('body')

	<script src="{{ asset('js/app.js') }}?v=1.0"></script>
	@yield('js')

	</body>
</html>
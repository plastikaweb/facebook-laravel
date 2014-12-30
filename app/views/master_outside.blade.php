<!doctype html>
<html>
	<head>
        <meta charset="utf-8">
        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <!--  Mobile Viewport Fix -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        @section('metatags')
        @show

        <title>Laravel - Facebook</title>

        <!-- <css styles> -->
        {{ HTML::style('//fonts.googleapis.com/css?family=Lato') }}
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/style.css?v=1') }}

        @section('css')

        @show
        <!-- </css styles> -->

	</head>

	<body>

        <!-- Facebook sdk javascript API -->
        <div class="container">
             @yield('content')
        </div>

        <!-- <scripts> -->
        {{ HTML::script('js/jquery.min.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}
        <!-- </scripts> -->

	</body>

</html>
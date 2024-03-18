<!doctype html>
<html class="fixed">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
        <meta name="author" content="JSOFT.net">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="icon" type="image/png" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"/>
        <link rel="stylesheet" href="{{ URL::asset('css/magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/datepicker3.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/jquery-ui-1.10.4.custom.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/select2.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/theme.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/default.css') }}" />
        <link rel="stylesheet" href="https://colorlib.com/polygon/octopus/assets/stylesheets/theme-custom.css">
        @yield("css")
    </head>
    <body ng-app="myApp">
        @yield("content")
    </body>
    <script src="{{ URL::asset('js/modernizr.js') }}" type="ce89803f4e0fb1e066d18855-text/javascript"></script>
    <script src="{{ URL::asset('js/jquery.js') }}" type="ce89803f4e0fb1e066d18855-text/javascript"></script>
    <script src="{{ URL::asset('js/jquery.browser.mobile.js') }}" type="ce89803f4e0fb1e066d18855-text/javascript"></script>
    <script src="{{ URL::asset('js/bootstrap.js') }}" type="ce89803f4e0fb1e066d18855-text/javascript"></script>
    <script src="{{ URL::asset('js/nanoscroller.js') }}" type="ce89803f4e0fb1e066d18855-text/javascript"></script>
    <script src="{{ URL::asset('js/bootstrap-datepicker.js') }}" type="ce89803f4e0fb1e066d18855-text/javascript"></script>
    <script src="{{ URL::asset('js/magnific-popup.js') }}" type="ce89803f4e0fb1e066d18855-text/javascript"></script>
    <script src="{{ URL::asset('js/jquery.placeholder.js') }}" type="ce89803f4e0fb1e066d18855-text/javascript"></script>
    <script src="{{ URL::asset('js/jquery-ui-1.10.4.custom.js') }}" type="ce89803f4e0fb1e066d18855-text/javascript"></script>
    <script src="{{ URL::asset('js/select2.js') }}" type="ce89803f4e0fb1e066d18855-text/javascript"></script>
    <script src="{{ URL::asset('js/jquery.ui.touch-punch.js') }}" type="ce89803f4e0fb1e066d18855-text/javascript"></script>
    <script src="{{ URL::asset('js/theme.js') }}" type="ce89803f4e0fb1e066d18855-text/javascript"></script>
    <script src="https://colorlib.com/polygon/octopus/assets/javascripts/theme.custom.js" type="ce89803f4e0fb1e066d18855-text/javascript"></script>
    <script src="{{ URL::asset('js/theme.init.js') }}" type="ce89803f4e0fb1e066d18855-text/javascript"></script>
    <script src="{{ URL::asset('js/rocket-loader.min.js') }}" data-cf-settings="ce89803f4e0fb1e066d18855-|49" defer=""></script>
    <script src="{{ URL::asset('js/jquery-1.9.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.6/jstz.js"></script>
    <script>
    $(document).ready(function(){
        var timezone = jstz.determine();
        document.cookie="local_timezone="+timezone.name();
    });
    </script>
    @yield("js")
</html>
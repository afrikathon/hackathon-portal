<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('paper') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('paper') }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://afrikathon.org/"/>


    <!--  Social tags      -->
    <meta name="keywords" content="Afrikathon">
    <meta name="description" content="The Opportunity Hackathon
HACK THE LABOUR SYSTEM
Rich in diversity and culture, let’s tap into our innermost potential to create the solutions for our future to make over 400 million talented Africans access to evenly distributed opportunity.">


    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Afrikathon ">
    <meta itemprop="description" content="The Opportunity Hackathon
HACK THE LABOUR SYSTEM
Rich in diversity and culture, let’s tap into our innermost potential to create the solutions for our future to make over 400 million talented Africans access to evenly distributed opportunity.">

    <meta itemprop="image"
          content="https://avatars3.githubusercontent.com/u/60590865?s=200&v=4">


    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@afrikathon">
    <meta name="twitter:title" content="Afrikathon ">

    <meta name="twitter:description" content="The Opportunity Hackathon
HACK THE LABOUR SYSTEM
Rich in diversity and culture, let’s tap into our innermost potential to create the solutions for our future to make over 400 million talented Africans access to evenly distributed opportunity.">
    <meta name="twitter:creator" content="@afrikathon">
    <meta name="twitter:image"
          content="https://avatars3.githubusercontent.com/u/60590865?s=200&v=4">


    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Afrikathon"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="https://avatars3.githubusercontent.com/u/60590865?s=200&v=4"/>
    <meta property="og:image"
          content="https://avatars3.githubusercontent.com/u/60590865?s=200&v=4"/>
    <meta property="og:description"
          content="The Opportunity Hackathon
HACK THE LABOUR SYSTEM
Rich in diversity and culture, let’s tap into our innermost potential to create the solutions for our future to make over 400 million talented Africans access to evenly distributed opportunity."/>
    <meta property="og:site_name" content="Afrikathon"/>

    <title>
        {{ __('Afrikathon') }}
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('paper') }}/demo/demo.css" rel="stylesheet"/>

</head>

<body class="{{ $class }}">
@auth()
    @include('layouts.page_templates.auth')
@endauth

@guest
    @include('layouts.page_templates.guest')
@endguest

<!--   Core JS Files   -->
<script src="{{ asset('paper') }}/js/core/jquery.min.js"></script>
<script src="{{ asset('paper') }}/js/core/popper.min.js"></script>
<script src="{{ asset('paper') }}/js/core/bootstrap.min.js"></script>
<script src="{{ asset('paper') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
{{--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>--}}
<!-- Chart JS -->
{{--<script src="{{ asset('paper') }}/js/plugins/chartjs.min.js"></script>--}}
<!--  Notifications Plugin    -->
<script src="{{ asset('paper') }}/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('paper') }}/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
<!-- Afrikathon DEMO methods, don't include it in your project! -->
<script src="{{ asset('paper') }}/demo/demo.js"></script>
<!-- Sharrre libray -->
<script src="{{ asset('paper') }}/demo/jquery.sharrre.js"></script>

@stack('scripts')

</body>

</html>

<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="IPTECH-CI">
    <meta name="keywords" content="IPTECH-CI,ecole,eleve,etablissement">
    <meta name="author" content="Amia Stephane - r4gamia@gmail.com">
    <title>BABILOTO - @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/logo/icon_iptechci.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/logo/icon_iptechci.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    @include('layouts.styles')
</head>
<!-- END: Head-->
<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static   menu-collapsed"
      data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
@include('layouts.sidebar')
<!-- BEGIN: Content-->
<div class="app-content content">
    @include('layouts.header')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">@yield('title')</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Tableau de Bord</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">@yield('title')</a>
                                </li>
                                <li class="breadcrumb-item active">@yield('subTitle')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            @include('message.messages')
            @yield('content')
        </div>
    </div>

</div>
<!-- END: Content-->

<script>
    window.baseUrl = '{{ url('/') }}'
</script>
@include('layouts.footer')
@include('layouts.scripts')
</body>

</html>

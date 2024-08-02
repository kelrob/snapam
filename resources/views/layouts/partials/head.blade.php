@section('meta')
    <meta charset="UTF-8">
    <!-- responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Google Fonts -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('head_links')
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@300;400;500;600;700;800;900&amp;display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&amp;display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css' )}}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icomoon.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/css/imp.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.bootstrap-touchspin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}">

    <!-- Module css -->
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/header-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/banner-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/about-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/blog-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/fact-counter-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/faq-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/contact-page.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/breadcrumb-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/team-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/partner-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/testimonial-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/services-section.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/module-css/footer-section.css') }}">


    <link href="{{ asset('assets/css/color/theme-color.css') }}" id="jssDefault" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
@endsection

@section('head_scripts')
    <!-- Fixing Internet Explorer-->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="{{ asset('assets/js/html5shiv.js') }}"></script>
    <![endif]-->
@endsection

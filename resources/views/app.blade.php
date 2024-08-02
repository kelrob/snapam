<!DOCTYPE html>
<html lang="en" data-x="html" data-x-toggle="html-overflow-hidden">

<head>
    <!-- Required meta tags -->
    @yield('meta')

    @yield('head_links')

    <title>@yield('title') </title>
</head>

<body>


<main>
    @yield('header')

    @yield('content')


    @include('layouts.partials.footer')
</main>


@include('layouts.partials.footer-scripts')
</body>
@
</html>

@extends('app')
@include('layouts.partials.head')

@section('title', 'Snapam :: Make Lagos Clean - HOME')

@section('header')
    @include('layouts.partials.header')
@endsection

@section('content')
    <div class="boxed_wrapper ltr">

        <!-- Start Main Slider -->
        @include('layouts.sections.index.main-slider')
        <!-- End Main Slider -->

        <!--Start Features Style1 Area-->
        @include('layouts.sections.index.feature-style')
        <!--End Features Style1 Area-->

        <!--Start About Style1 Area-->
        @include('layouts.sections.index.about-style')
        <!--End About Style1 Area-->

        <!--Start Service Style1 Area-->
        @include('layouts.sections.index.service-style')
        <!--End Service Style1 Area-->


        <!--Start Partner Area-->
        @include('layouts.sections.index.partners')
        <!--End Partner Area-->

        <!--Start Features Style2 Area-->
        @include('layouts.sections.index.feature-style2')
        <!--End Features Style2 Area-->

        <!--Start Service Style2 Area-->
        @include('layouts.sections.index.service-style2')
        <!--End Service Style2 Area-->


        <!--Start Choose Style1 Area-->
        @include('layouts.sections.index.choose-style')
        <!--End Choose Style1 Area-->


        <!--Start Fact Counter Area-->
        @include('layouts.sections.index.facts-counter')
        <!--End Fact Counter Area-->


        <!--Start Contact Info Style1 Area-->
        @include('layouts.sections.index.contact')
        <!--End Contact Info Style1 Area-->


        <!--Start slogan area-->
        @include('layouts.sections.index.slogan-area')
        <!--End slogan area-->

        @include('layouts.partials.modals.capture-dialog')
        <button class="scroll-top scroll-to-target" data-target="html">
            {{--            <span class="flaticon-up-arrow text-white"></span>--}}
            <span>^</span>
        </button>

    </div>
@endsection

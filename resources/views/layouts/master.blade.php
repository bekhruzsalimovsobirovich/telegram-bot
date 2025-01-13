<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>OXU UZ</title>

    <!-- Global stylesheets -->
    <link href="{{ asset('assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/ltr/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ asset('assets/demo/demo_configurator.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('assets/js/vendor/visualization/d3/d3.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/visualization/d3/d3_tooltip.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{asset('assets/demo/pages/dashboard.js')}}"></script>
    <script src="{{asset('assets/demo/charts/pages/dashboard/streamgraph.js')}}"></script>
    <script src="{{asset('assets/demo/charts/pages/dashboard/sparklines.js')}}"></script>
    <script src="{{asset('assets/demo/charts/pages/dashboard/lines.js')}}"></script>
    <script src="{{asset('assets/demo/charts/pages/dashboard/areas.js')}}"></script>
    <script src="{{asset('assets/demo/charts/pages/dashboard/donuts.js')}}"></script>
    <script src="{{asset('assets/demo/charts/pages/dashboard/bars.js')}}"></script>
    <script src="{{asset('assets/demo/charts/pages/dashboard/progress.js')}}"></script>
    <script src="{{asset('assets/demo/charts/pages/dashboard/heatmaps.js')}}"></script>
    <script src="{{asset('assets/demo/charts/pages/dashboard/pies.js')}}"></script>
    <script src="{{asset('assets/demo/charts/pages/dashboard/bullets.js')}}"></script>
    <!-- /theme JS files -->

</head>

<body>

<!-- Main navbar -->
@include('partials.navbar')
<!-- /main navbar -->


<!-- Page content -->
<div class="page-content">

    <!-- Main sidebar -->
    @include('partials.sidebar')
    <!-- /main sidebar -->


    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Inner content -->
        <div class="content-inner">

            <!-- Page header -->
            <div class="page-header page-header-light shadow">
                <div class="page-header-content d-lg-flex">
                    <div class="d-flex">
                        <h4 class="page-title mb-0">
                            Home - <span class="fw-normal">Dashboard</span>
                        </h4>

                        <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                            <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">
                @yield('content')
            </div>
            <!-- /content area -->


            <!-- Footer -->
            @include('partials.footer')
            <!-- /footer -->

        </div>
        <!-- /inner content -->

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

</body>
</html>

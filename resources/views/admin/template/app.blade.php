<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>@stack('title', 'Footbal Portal')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
        <meta content="Abul Hassan" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- Theme Config Js -->
        <script src="{{asset('assets/js/config.js')}}"></script>

        <!-- App css -->
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
     
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
crossorigin="anonymous" referrerpolicy="no-referrer" />

        @stack('select2')
       


    </head>

    <body>
        <!-- Begin page -->
        <div class="wrapper">

            
            <!-- ========== Topbar Start ========== -->
            @include('admin.template.include.top-menu')
            <!-- ========== Topbar End ========== -->
            

            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.template.include.left-menu')
            <!-- ========== Left Sidebar End ========== -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
            @yield('main-content')

                <!-- Footer Start -->
              @include('admin.template.include.footer')
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Theme Settings -->


        <!-- Vendor js -->
        <script src="{{asset('assets/js/vendor.min.js')}}"></script>
        
        <!-- App js -->
        <script src="{{asset('assets/js/app.min.js')}}"></script>
        <!-- Add these lines to your layout.blade.php or wherever your main layout file is -->
        

    </body>


</html>

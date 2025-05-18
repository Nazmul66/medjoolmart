<!doctype html>
<html lang="en">
    
<!-- Meta-Titles Head Tag -->
@include("backend.include.meta-titles")

<body>

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

        <!-- Header part -->
        @include("backend.include.header")

            <!-- ========== Left Sidebar Start ========== -->
            @include("backend.include.sidebar")
            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- body content -->
                        @yield("body-content")

                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- Footer part -->
                @include("backend.include.footer")
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        
   
        <!-- Others blade section -->
        @include("backend.include.others")

        <!-- Script tags -->
        @include("backend.include.scripts")

    </body>
</html>
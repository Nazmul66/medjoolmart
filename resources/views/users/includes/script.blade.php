
<div class="wsus__scroll_btn">
    <i class="fas fa-chevron-up"></i>
</div>


<!--jquery library js-->
<script src="{{ asset('public/user/js/jquery-3.6.0.min.js') }}"></script>
<!--bootstrap js-->
<script src="{{ asset('public/user/js/bootstrap.bundle.min.js') }}"></script>
<!--font-awesome js-->
<script src="{{ asset('public/user/js/Font-Awesome.js') }}"></script>
<!--select2 js-->
<script src="{{ asset('public/user/js/select2.min.js') }}"></script>
<!--slick slider js-->
<script src="{{ asset('public/user/js/slick.min.js') }}"></script>
<!-- simplyCountdown js-->
<script src="{{ asset('public/user/js/simplyCountdown.js') }}"></script>

<!--product zoomer js-->
<script src="{{ asset('public/user/js/jquery.exzoom.js') }}"></script>
<!--nice-number js-->
<script src="{{ asset('public/user/js/jquery.nice-number.min.js') }}"></script>
<!--counter js-->
<script src="{{ asset('public/user/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('public/user/js/jquery.countup.min.js') }}"></script>
<!--add row js-->
<script src="{{ asset('public/user/js/add_row_custon.js') }}"></script>
<!--multiple-image-video js-->
<script src="{{ asset('public/user/js/multiple-image-video.js') }}"></script>

<!--sticky sidebar js For product Details page-->
<script src="{{ asset('public/user/js/sticky_sidebar.js') }}"></script>

<!--price ranger js-->
<script src="{{ asset('public/user/js/ranger_jquery-ui.min.js') }}"></script>
<script src="{{ asset('public/user/js/ranger_slider.js') }}"></script>

<!--Toaster Js Implement-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!--isotope js-->
<script src="{{ asset('public/user/js/isotope.pkgd.min.js') }}"></script>
<!--venobox js-->
<script src="{{ asset('public/user/js/venobox.min.js') }}"></script>
<!--classycountdown js-->
<script src="{{ asset('public/user/js/jquery.classycountdown.js') }}"></script>

<!--main/custom js-->
<script src="{{ asset('public/user/js/main.js') }}"></script>


@stack('add-js')

<script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
</script>

<script type="text/javascript">
    @if ( Session::has('message') )

        var type = "{{ Session::get('alert-type') }}";

        switch(type){
            case "info":
               toastr.info("{{ Session::get('message') }}");
            break; 

            case "success":
               toastr.success("{{ Session::get('message') }}");
            break;
            
            case "warning":
               toastr.warning("{{ Session::get('message') }}");
            break;

            case "error":
               toastr.error("{{ Session::get('message') }}");
            break;
        }
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{!! $error !!}");
        @endforeach
    @endif


// Ajax Setup
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

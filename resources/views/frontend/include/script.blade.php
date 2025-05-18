{{-- <script type="text/javascript" src="{{ asset('public/frontend/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script> --}}


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script type="text/javascript" src="{{ asset('public/frontend/js/swiper-bundle.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/frontend/js/carousel.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('public/frontend/js/bootstrap-select.min.js') }}"></script> --}}
{{-- <script type="text/javascript" src="{{ asset('public/frontend/js/lazysize.min.js') }}"></script> --}}
{{-- <script type="text/javascript" src="{{ asset('public/frontend/js/count-down.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('public/frontend/js/wow.min.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
{{-- <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script> --}}
<script type="text/javascript" src="{{ asset('public/frontend/js/multiple-modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/frontend/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script defer src="https://sibforms.com/forms/end-form/build/main.js"></script> --}}

<!--Toaster Notification Js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    {{-- Toaster Notification --}}
    {!! Toastr::message() !!}

    <script>
        // Skeleton loader added
        $(document).ready(function(){
            $('.skeleton').each(function(){
                $(this).on('load', function(){
                    $(this).removeClass('skeleton');
                }).trigger('load'); // Manually trigger load in case it's already loaded
            });
            $('.skeleton2').each(function(){
                $(this).on('load', function(){
                    $(this).removeClass('skeleton2');
                }).trigger('load'); // Manually trigger load in case it's already loaded
            });
            $('.banner_slider').each(function(){
                $(this).on('load', function(){
                    $(this).removeClass('banner_slider');
                }).trigger('load'); // Manually trigger load in case it's already loaded
            });
        })

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{!! $error !!}");
                console.log('Error:', "{!! $error !!}"); // Debugging line
            @endforeach
        @endif
    </script>

@stack('add-js')

<script>
    // Ajax Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

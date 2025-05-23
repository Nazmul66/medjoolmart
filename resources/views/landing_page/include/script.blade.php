<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

 <!-- toaster Js plugins  -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stack('add-js')

 <!-- toaster Js plugins  -->
 <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>

{!! Toastr::message() !!}

<script type="text/javascript">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{!! $error !!}");
        @endforeach
    @endif
</script>

{{-- Pusher Js Start --}}
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('29983ad499efd408200f', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        // alert(JSON.stringify(data.message));
        if( data ){
            toastr.success(data.message);
        }
        else{
            toastr.error("there is something wrong");
        }
    });
</script>
{{-- Pusher Js End --}}

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
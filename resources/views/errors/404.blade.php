@extends('frontend.layout.master')

@push('add-meta')
    <title>Sazao || About-us Template</title>
@endpush

@push('add-css')

@endpush


@section('body-content')

        <!-- 404 -->
        <section class="flat-spacing page-404">
            <div class="container">
                <div class="page-404-inner">
                    <div class="image">
                        <img class="lazyload" data-src="{{ asset('public/frontend/images/section/404.png') }}" src="{{ asset('public/frontend/images/section/404.png') }}" alt="image">
                    </div>
                    <div class="content">
                        <div class="heading">Oops!</div>
                        <div>
                            <h2 class="title mb_4">Something is Missing.</h2> 
                            @if ( $exception->getMessage() )
                                <div class="text body-text-1 text-secondary">
                                    Oops! {{ $exception->getMessage() }} </div>
                            @else
                                <div class="text body-text-1 text-secondary">
                                    {{  'Oops! The page "' . Request::segment(count(Request::segments())) . '" you are looking for cannot be found. Please check the URL or return to the homepage and try again.'  ?? 'The page you are looking for cannot be found. Take a break before trying again.' }}
                                </div>
                            @endif

                        </div>
                        <a href="{{ url('/') }}" class="tf-btn btn-fill"><span class="text text-button">Back To Homepage</span></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /404 -->

@endsection

@push('add-js')

@endpush
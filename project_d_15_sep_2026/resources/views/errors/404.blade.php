@extends('errors.layouts.main')

@section('title', '404 - Page Not Found')

@section('content')

<div class="error-page">

    <div class="error-card">

        <!-- SHREE T N LOGO -->
        <img
            src="{{ commonData('stnLogoPath') }}"
            alt="SHREE T N"
            class="error-logo"
        >

        <div class="error-code">
            404
        </div>

        <div class="error-title">
            Page Not Found
        </div>

        <p class="error-message">
            Sorry, the page you are looking for does not exist
            or the URL may be incorrect.
        </p>

        @if (app()->environment('local'))
            @if (!empty($message))
                <p>
                    {!! nl2br(e($message)) !!}
                </p>
            @endif
        @else
            <p>
                Sorry, we cannot find the page you are looking for.
            </p>
        @endif

        <a href="{{ url('/') }}"
           class="home-btn">

            <i class="fa fa-home"></i>
            Go to Home Page

        </a>

    </div>

</div>

@endsection
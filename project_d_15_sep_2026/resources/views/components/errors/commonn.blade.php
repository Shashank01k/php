<div id="stn-error-page">

    {{-- Repeated watermark --}}
    <div id="stn-error-watermark"></div>

    {{-- Decorative shapes --}}
    <div
        id="stn-error-shape-one"
        class="stn-error-shape"
    ></div>

    <div
        id="stn-error-shape-two"
        class="stn-error-shape"
    ></div>

    <div
        id="stn-error-shape-three"
        class="stn-error-shape"
    ></div>

    <div id="stn-error-wave"></div>


    {{-- Main content --}}
    <div id="stn-error-content">

        {{-- Logo --}}
        <img
            id="stn-error-logo"
            src="{{ commonData('stnLogoPath') }}"
            alt="SHREE T N"
        >


        {{-- Error Code --}}
        <div id="stn-error-code">
            {{ $code ?? '404' }}
        </div>


        {{-- Error Title --}}
        <div id="stn-error-title">
            {{ $title ?? 'Page Not Found' }}
        </div>


        {{-- Main Message --}}
        <p id="stn-error-message">
            {{ $message ?? 'Sorry, the page you are looking for does not exist or the URL may be incorrect.' }}
        </p>


        {{-- Local Environment Details --}}
        @if (app()->environment('local'))

            @if (!empty($details))

                <div id="stn-error-details">
                    {!! nl2br(e($details)) !!}
                </div>

            @endif

        @else

            @if (!empty($productionMessage))

                <div id="stn-error-details">
                    {{ $productionMessage }}
                </div>

            @endif

        @endif


        {{-- Home --}}
        <a
            id="stn-error-home-btn"
            href="{{ $buttonUrl ?? url('/') }}"
        >
            <i class="fa fa-home"></i>

            {{ $buttonText ?? 'Go to Home Page' }}

        </a>

    </div>

</div>
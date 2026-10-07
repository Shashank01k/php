<div class="error-page">

    <div class="error-card">

        {{-- Logo --}}
        <img
            src="{{ commonData('stnLogoPath') }}"
            alt="SHREE T N"
            class="error-logo"
        >

        {{-- Error Code --}}
        <div class="error-code">
            {{ $code ?? '404' }}
        </div>

        {{-- Error Title --}}
        <div class="error-title">
            {{ $title ?? 'Page Not Found' }}
        </div>

        {{-- Error Message --}}
        <p class="error-message">
            {{ $message ?? 'Sorry, the page you are looking for does not exist or the URL may be incorrect.' }}
        </p>

        {{-- Environment Specific Message --}}
        @if (app()->environment('local'))

            @if (!empty($details))
                <p class="error-details">
                    {!! nl2br(e($details)) !!}
                </p>
            @endif

        @else

            @if (!empty($productionMessage))
                <p class="error-details">
                    {{ $productionMessage }}
                </p>
            @endif

        @endif

        {{-- Home Button --}}
        <a
            href="{{ $buttonUrl ?? url('/') }}"
            class="home-btn"
        >
            <i class="fa fa-home"></i>

            {{ $buttonText ?? 'Go to Home Page' }}
        </a>

    </div>

</div>
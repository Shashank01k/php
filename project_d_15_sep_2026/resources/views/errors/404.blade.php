<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>404 - Page Not Found</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            background: #f8f8f8;
        }

        .error-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .error-card {
            width: 100%;
            max-width: 500px;
            padding: 45px 30px;
            text-align: center;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        }

        .error-logo {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .error-code {
            font-size: 70px;
            line-height: 1;
            font-weight: 800;
            color: #e53900;
            margin-bottom: 10px;
        }

        .error-title {
            font-size: 25px;
            font-weight: 700;
            color: #222;
            margin-bottom: 10px;
        }

        .error-message {
            color: #777;
            margin-bottom: 25px;
        }

        .home-btn {
            background: #e53900;
            border: none;
            color: #fff;
            padding: 10px 25px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }

        .home-btn:hover {
            background: #c62800;
            color: #fff;
        }
    </style>
</head>

<body>

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

</body>
</html>
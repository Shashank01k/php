<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        @yield('title', 'Error Found!')
    </title>

    @yield('styles')

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fa;
        }

        .error-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background: #f5f7fa;
        }

        .error-card {
            width: 100%;
            max-width: 600px;
            text-align: center;
            background: #ffffff;
            padding: 50px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        }

        .error-logo {
            max-width: 180px;
            max-height: 80px;
            margin-bottom: 25px;
        }

        .error-code {
            font-size: 90px;
            font-weight: 700;
            line-height: 1;
            color: #1f2937;
            margin-bottom: 15px;
        }

        .error-title {
            font-size: 30px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 15px;
        }

        .error-message {
            max-width: 480px;
            margin: 0 auto 15px;
            font-size: 16px;
            line-height: 1.7;
            color: #6b7280;
        }

        .error-details {
            max-width: 500px;
            margin: 15px auto;
            padding: 12px 15px;
            text-align: left;
            font-size: 13px;
            line-height: 1.6;
            color: #6b7280;
            background: #f8f9fa;
            border-radius: 6px;
            word-break: break-word;
        }

        .home-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            border-radius: 6px;
            background: #2563eb;
            color: #ffffff;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: 0.2s ease;
        }

        .home-btn:hover {
            background: #1d4ed8;
            color: #ffffff;
            text-decoration: none;
        }

        .home-btn i {
            margin-right: 7px;
        }

        @media (max-width: 576px) {

            .error-card {
                padding: 40px 20px;
            }

            .error-code {
                font-size: 70px;
            }

            .error-title {
                font-size: 24px;
            }

        }

    </style>

</head>

<body>
    <div class="page-with-sidebar">

        {{-- Header --}}
        @include('errors.partials.header')

        {{-- Main Page Content --}}
        <main>
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('errors.partials.footer')

    </div>

    @yield('scripts')

</body>

</html>
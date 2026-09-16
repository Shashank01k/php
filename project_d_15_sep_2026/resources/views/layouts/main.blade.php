<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin Dashboard')
    </title>

    <!-- Bootstrap 5 CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    >

    @yield('styles')
</head>

<body>

    <div class="page-with-sidebar">

        {{-- Header --}}
        @include('partials.header')


        {{-- Navbar --}}
        @if (session('isLoggedIn') && !empty(session('id')))
            @include('partials.navbar')
        @endif


        {{-- Sidebar --}}
        @include('partials.sidebar')


        {{-- Main Page Content --}}
        <main>
            @yield('content')
        </main>


        {{-- Footer --}}
        @include('partials.footer')

    </div>


    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar JS -->
    <script src="{{ asset('assets/js/partials/sidebar.js') }}"></script>

    @yield('scripts')

</body>

</html>
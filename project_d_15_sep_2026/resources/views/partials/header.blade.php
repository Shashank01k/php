<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

{{-- CSRF --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ $title ?? 'SHREE T N' }}</title>


<!-- Font Awesome -->
<link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
>

<!-- Bootstrap 5 -->
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
>


<!-- Project CSS -->
<link
    rel="stylesheet"
    href="{{ asset('assets/css/style.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('assets/css/partials/footer.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('assets/css/admin/dashboard/index.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('assets/css/partials/sidebar.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('assets/css/welcome.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('assets/css/users/auth/register.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('assets/css/users/auth/login.css') }}"
>


{{-- <link
    rel="stylesheet"
    href="{{ asset('assets/css/update.css') }}"
> --}}

@yield('styles')
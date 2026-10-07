<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ $title ?? 'SHREE T N' }}</title>

<!-- Bootstrap 5 -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<!-- Font-Awesome -->
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
>

<!-- Project CSS -->
<link
    rel="stylesheet"
    href="{{ asset('assets/css/errors/style.css') }}"
>

<link
    rel="stylesheet"
    href="{{ asset('assets/css/errors/common.css') }}"
>

@yield('styles')
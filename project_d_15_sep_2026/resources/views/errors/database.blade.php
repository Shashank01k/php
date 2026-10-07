@extends('errors.layouts.main')

@section('title', 'Service Unavailable')

@section('content')

    {{-- <h1>Service temporarily unavailable</h1>

    <p>
        We are unable to connect to the database.
        Please try again later.
    </p> --}}

      <x-errors.commonn
        code="404"
        title="Service temporarily unavailable"
        message=" We are unable to connect to the database. Please try again later."
        productionMessage="Sorry, we cannot find the page you are looking for."
    />

@endsection
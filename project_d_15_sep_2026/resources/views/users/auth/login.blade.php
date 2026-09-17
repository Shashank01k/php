@extends('layouts.main')

@section('title', 'User Login')

@section('content')

<div class="user-login-wrapper">

    {{-- Validation / Error Message --}}
    @if ($errors->any())

        <div class="alert alert-danger"
             role="alert"
             style="font-size: 12px;">

            {{ $errors->first() }}

        </div>

    @endif


    {{-- Flash Error Message --}}
    @if (session('error'))

        <div class="alert alert-danger"
             role="alert"
             style="font-size: 12px;">

            {{ session('error') }}

        </div>

    @endif


    <h5 class="user-login-title">
        Users Login
    </h5>


    {{-- SHREE T N LOGO --}}
    <div class="user-login-logo">

        <img
            src="{{ asset('assets/images/stn/shree_tn_logo.svg') }}"
            alt="SHREE T N">

    </div>


    <form
        action="{{ route('users.login.submit') }}"
        method="POST"
        class="p-2">

        @csrf


        {{-- Email --}}
        <div class="user-login-form-field">

            <i class="fa fa-user" aria-hidden="true"></i>

            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                placeholder="Email"
                required>

        </div>


        {{-- Password --}}
        <div class="user-login-form-field">

            <i class="fa fa-key" aria-hidden="true"></i>

            <input
                type="password"
                name="password"
                id="pwd"
                placeholder="Password"
                required>

        </div>


        <button
            type="submit"
            class="user-login-btn mt-2">

            Login

        </button>

    </form>


    <div class="user-login-signup">

        Don't have an account?

        <a href="{{ route('users.register') }}">
            Sign up
        </a>

    </div>

</div>

@endsection
@extends('layouts.main')

@section('title', $title ?? 'User Registration Form')

@section('content')

<div class="signup-page">

    <div class="signup-wrapper">

        <div class="signup-card">

            <div class="row g-0">

                <!-- LEFT SIDE -->
                <div class="col-md-5 signup-left">

                    <h2>Create an Account</h2>

                    <i class="fa fa-user-plus signup-icon"></i>

                    <h4>Create an Account</h4>

                    <p>
                        Join us today and create your account.
                    </p>

                </div>


                <!-- RIGHT SIDE -->
                <div class="col-md-7 signup-right">

                    <h3>Create your account</h3>

                    <form
                        action="{{ url($userTypeUrl . '/register') }}"
                        method="POST"
                        class="signup-form"
                    >

                        @csrf

                        <!-- Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Success Message | Error Message -->
                        @include('components.flash_alert_message')


                        <!-- First Name -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>

                                <input
                                    type="text"
                                    name="firstname"
                                    class="form-control"
                                    placeholder="First Name"
                                    value="{{ old('firstname') }}"
                                >

                            </div>

                        </div>


                        <!-- Last Name -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>

                                <input
                                    type="text"
                                    name="lastname"
                                    class="form-control"
                                    placeholder="Last Name"
                                    value="{{ old('lastname') }}"
                                >

                            </div>

                        </div>


                        <!-- Email -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa fa-envelope"></i>
                                </span>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Email Address"
                                    value="{{ old('email') }}"
                                >

                            </div>

                        </div>


                        <!-- Phone -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa fa-phone"></i>
                                </span>

                                <span class="input-group-text">
                                    +91
                                </span>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    placeholder="Phone Number"
                                    value="{{ old('phone') }}"
                                >

                            </div>

                        </div>


                        <!-- Gender -->
                        <div class="form-group">

                            <label class="me-3">
                                Gender:
                            </label>

                            <div class="form-check form-check-inline">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    value="male"
                                    {{ old('gender') === 'male' ? 'checked' : '' }}
                                >

                                <label class="form-check-label">
                                    Male
                                </label>

                            </div>

                            <div class="form-check form-check-inline">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    value="female"
                                    {{ old('gender') === 'female' ? 'checked' : '' }}
                                >

                                <label class="form-check-label">
                                    Female
                                </label>

                            </div>

                            <div class="form-check form-check-inline">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    value="other"
                                    {{ old('gender') === 'other' ? 'checked' : '' }}
                                >

                                <label class="form-check-label">
                                    Other
                                </label>

                            </div>

                        </div>


                        <!-- State -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa fa-map-marker"></i>
                                </span>

                                <select
                                    name="state"
                                    class="form-select"
                                >

                                    <option value="">
                                        Select State
                                    </option>

                                    @if (!empty($statesArrayData))

                                        @foreach ($statesArrayData as $state)

                                            <option
                                                value="{{ $state->id }}"
                                                {{ old('state') == $state->id ? 'selected' : '' }}
                                            >
                                                {{ $state->name }}
                                            </option>

                                        @endforeach

                                    @endif

                                </select>

                            </div>

                        </div>


                        <!-- Password -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control"
                                    placeholder="Password"
                                    autocomplete="off"
                                >

                                <!-- Password Hide and Show Button -->
                                <button
                                    type="button"
                                    class="btn btn-outline-secondary password-toggle"
                                    data-target="password"
                                    aria-label="Show password"
                                >
                                    <i class="fa fa-eye"></i>
                                </button>

                            </div>

                            {{-- Users Registration Forms Password Rules --}}
                            @include('components.password.rules')

                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>

                                <input
                                    type="password"
                                    id="confirmpassword"
                                    name="confirmpassword"
                                    class="form-control"
                                    placeholder="Confirm Password"
                                >

                                <button
                                    type="button"
                                    class="btn btn-outline-secondary password-toggle"
                                    data-target="confirmpassword"
                                    aria-label="Show password"
                                >
                                    <i class="fa fa-eye"></i>
                                </button>

                            </div>

                        </div>


                        <!-- Submit -->
                        <button
                            type="submit"
                            class="btn btn-primary signup-submit"
                        >
                            Create your account
                        </button>

                    </form>


                    @if ((int) session('user_type') !== \App\Models\User::ADMIN)

                        <!-- Divider -->
                        <div class="signup-divider">
                            OR
                        </div>


                        <!-- Login -->
                        <p class="signup-login">

                            Already Registered?

                            <a href="{{ url('users/login') }}">
                                Log in
                            </a>

                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>


@endsection


@section('scripts')

<script src="{{ asset('assets/js/components/password/rules.js') }}"></script>

@endsection
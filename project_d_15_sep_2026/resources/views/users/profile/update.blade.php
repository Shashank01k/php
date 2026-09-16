@extends('layouts.main')

@section('title', $title ?? 'User Updation')

@section('content')

<div class="container">

    <div class="col-md-12">

        <div class="col-6">

            <legend>
                <b>{{ $headerName }}</b>
            </legend>

            <br>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

                <br>
            @endif

            @if (isset($flashMessage))
                <div class="alert alert-success" role="alert">
                    {{ $flashMessage }}
                </div>

                <br>
            @endif

            @if (session('updateMessage'))
                <div class="alert alert-success" role="alert">
                    {{ session('updateMessage') }}
                </div>

                <br>
            @endif

            <form
                action="{{ url(
                    $userTypeUrl . '/profile/update/' . $userDataArray->id
                ) }}"
                method="POST"
            >

                @csrf

                <div class="form-group">

                    <label for="firstname">
                        First Name:
                    </label>

                    <br>

                    <input
                        type="text"
                        name="firstname"
                        id="firstname"
                        placeholder="First Name"
                        value="{{ old('firstname', $userDataArray->first_name) }}"
                        class="form-control"
                    >

                </div>

                <br>

                <div class="form-group">

                    <label for="lastname">
                        Last Name:
                    </label>

                    <br>

                    <input
                        type="text"
                        name="lastname"
                        id="lastname"
                        placeholder="Last Name"
                        value="{{ old('lastname', $userDataArray->last_name) }}"
                        class="form-control"
                    >

                </div>

                <br>

                <div class="form-group">

                    <label for="phone">
                        Phone Number:
                    </label>

                    <br>

                    <input
                        type="tel"
                        name="phone"
                        id="phone"
                        placeholder="Enter Your Mobile Number"
                        value="{{ old('phone', $userDataArray->phone) }}"
                        class="form-control"
                    >

                </div>

                <br>

                <div class="form-group">

                    <label for="email">
                        Email:
                    </label>

                    <br>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Email"
                        value="{{ $userDataArray->email }}"
                        class="form-control email-blur"
                        readonly
                    >

                </div>

                <br>

                <div class="form-group">

                    <p>Please select your Gender:</p>

                    <input
                        type="radio"
                        name="gender"
                        id="gender_male"
                        value="male"
                        {{ old('gender', $userDataArray->gender) === 'male' ? 'checked' : '' }}
                    >

                    <label for="gender_male">
                        Male
                    </label>

                    <input
                        type="radio"
                        name="gender"
                        id="gender_female"
                        value="female"
                        {{ old('gender', $userDataArray->gender) === 'female' ? 'checked' : '' }}
                    >

                    <label for="gender_female">
                        Female
                    </label>

                    <input
                        type="radio"
                        name="gender"
                        id="gender_other"
                        value="other"
                        {{ old('gender', $userDataArray->gender) === 'other' ? 'checked' : '' }}
                    >

                    <label for="gender_other">
                        Other
                    </label>

                </div>

                <br>

                <div class="form-group">

                    <label for="state">
                        State:
                    </label>

                    <br>

                    <select
                        id="state"
                        name="state"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Select State
                        </option>

                        @foreach ($statesArrayData as $state)

                            <option
                                value="{{ $state->id }}"
                                {{ old('state', $userDataArray->state) == $state->id ? 'selected' : '' }}
                            >
                                {{ $state->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <br>

                <div class="form-group buttons">

                    <button
                        type="submit"
                        class="btn btn-dark"
                    >
                        UPDATE
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
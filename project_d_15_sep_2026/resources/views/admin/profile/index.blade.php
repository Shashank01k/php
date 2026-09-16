@extends('layouts.main')

@section('title', $title ?? 'Admin Profile')

@section('content')

<div class="container-fluid py-4">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fa fa-user me-2"></i>
                        My Profile
                    </h5>
                </div>

                <div class="card-body">

                    <div class="text-center mb-4">

                        <i class="fa fa-user-circle fa-5x text-secondary"></i>

                        <h4 class="mt-2 mb-0">
                            {{ $userDataArray->first_name }}
                            {{ $userDataArray->last_name }}
                        </h4>

                        <small class="text-muted">
                            {{ $userDataArray->user_name }}
                        </small>

                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">
                            First Name
                        </div>

                        <div class="col-sm-8">
                            {{ $userDataArray->first_name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">
                            Last Name
                        </div>

                        <div class="col-sm-8">
                            {{ $userDataArray->last_name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">
                            Username
                        </div>

                        <div class="col-sm-8">
                            {{ $userDataArray->user_name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">
                            Email
                        </div>

                        <div class="col-sm-8">
                            {{ $userDataArray->email }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">
                            Phone
                        </div>

                        <div class="col-sm-8">
                            {{ $userDataArray->phone }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">
                            Gender
                        </div>

                        <div class="col-sm-8">
                            {{ $userDataArray->gender }}
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4 fw-bold">
                            State
                        </div>

                        <div class="col-sm-8">
                            {{ $userDataArray->state_name }}
                        </div>
                    </div>

                    <div class="text-end">

                        <a href="{{ route(
                            'admin.profile.edit',
                            $userDataArray->id
                        ) }}"
                           class="btn btn-dark">

                            <i class="fa fa-edit me-1"></i>
                            Edit Profile

                        </a>

                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
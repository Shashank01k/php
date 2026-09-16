@extends('layouts.main')

@section('title', 'Admin Dashboard')

@section('content')

@php
    $totalUsers = 0;
    $totalAssignments = 0;
    $pendingAssignments = 0;
    $completedAssignments = 0;
@endphp

<div class="container-fluid py-4">

    <h4 class="mb-4">Welcome To User Dashboard</h4>


    <!-- Success Message | Error Message -->
    @include('components.flash_alert_message')


    <!-- Summary Section -->
    <div class="mb-4">
        @include('admin.dashboard.sections.summary')
    </div>


    <!-- Profile Section -->
    <div class="mb-4">
        {{-- @include('admin.sections.profile') --}}
    </div>


    <!-- Assignment Section -->
    <div class="mb-4">
        @include('admin.dashboard.sections.assignment')
    </div>


    @if ($total > 0)

        <!-- Table -->
        <div class="card shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover table-bordered align-middle mb-0">

                        <thead class="table-dark">

                            <tr>

                                <!-- Actions -->
                                <th class="text-center" style="width: 80px;">

                                    <div class="dropdown">

                                        <button
                                            class="btn btn-sm btn-light dropdown-toggle"
                                            type="button"
                                            id="dropdownMenuButton"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                        >
                                            Actions
                                        </button>

                                        <ul
                                            class="dropdown-menu"
                                            aria-labelledby="dropdownMenuButton"
                                        >

                                            <li>
                                                <button
                                                    class="dropdown-item"
                                                    type="button"
                                                    onclick="selects()"
                                                >
                                                    Select
                                                </button>
                                            </li>

                                            <li>
                                                <button
                                                    class="dropdown-item"
                                                    type="button"
                                                    onclick="deSelect()"
                                                >
                                                    Deselect
                                                </button>
                                            </li>

                                            <li>
                                                <button
                                                    class="dropdown-item text-danger"
                                                    type="button"
                                                    onclick="deleteAllRows()"
                                                >
                                                    Delete
                                                </button>
                                            </li>

                                        </ul>

                                    </div>

                                </th>


                                <th class="text-center">Sr.No.</th>
                                <th>User Name</th>
                                <th>Phone</th>
                                <th>Email ID</th>
                                <th>Gender</th>
                                <th>State</th>
                                <th>Created Date</th>
                                <th class="text-center">Action</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($userDataArray as $userDataValue)

                                @php
                                    $userId = $userDataValue->u_id;

                                    $tempUserName = $userDataValue->user_name;
                                    $userName = $userDataValue->user_name;

                                    $tempStateName = $userDataValue->name;
                                    $stateName = $userDataValue->name;

                                    if (strlen($userName) >= 10) {
                                        $userName = substr($userName, 0, 10) . '...';
                                    }

                                    if (strlen($stateName) >= 12) {
                                        $stateName = substr($stateName, 0, 12) . '...';
                                    }
                                @endphp


                                <tr>

                                    <!-- Checkbox -->
                                    <td class="text-center">

                                        <input
                                            type="checkbox"
                                            class="form-check-input user-checkbox"
                                            name="chkRowId"
                                            value="{{ $userId }}"
                                        >

                                    </td>


                                    <!-- ID -->
                                    <td class="text-center">
                                        {{ $userId }}
                                    </td>


                                    <!-- Name -->
                                    <td>

                                        <span
                                            data-bs-toggle="tooltip"
                                            title="{{ $tempUserName }}"
                                            onclick="copyUserNameValue('{{ $tempUserName }}')"
                                            style="cursor:pointer;"
                                        >
                                            {{ ucwords($userName) }}
                                        </span>

                                    </td>


                                    <!-- Phone -->
                                    <td class="text-nowrap">
                                        {{ $userDataValue->phone }}
                                    </td>


                                    <!-- Email -->
                                    <td>
                                        {{ $userDataValue->email }}
                                    </td>


                                    <!-- Gender -->
                                    <td class="text-nowrap">
                                        {{ ucfirst($userDataValue->gender) }}
                                    </td>


                                    <!-- State -->
                                    <td>

                                        <span
                                            data-bs-toggle="tooltip"
                                            title="{{ $tempStateName }}"
                                        >
                                            {{ $stateName }}
                                        </span>

                                    </td>


                                    <!-- Created Date -->
                                    <td class="text-nowrap">

                                        {{ date('d M Y', strtotime($userDataValue->created_at)) }}

                                    </td>


                                    <!-- Actions -->
                                    <td class="text-center text-nowrap">

                                        <a
                                            href="{{ url('admin/users/profile/update/' . $userId) }}"
                                            class="btn btn-primary btn-sm"
                                        >
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </a>


                                        <a
                                            href="{{ url('admin/users/delete/' . $userId) }}"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to move this user to trash?')"
                                        >
                                            <i class="fa fa-trash"></i>
                                            Delete
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        <!-- Pagination -->
        @include('admin.users.pagination')

    @else

        <div class="alert alert-info text-center">
            No Data Found 😐
        </div>

    @endif

</div>


<script>
    const csrfTokenName = '{{ csrf_token() }}';
    const csrfHash = '{{ csrf_token() }}';
</script>


<script src="{{ asset('assets/js/admin/dashboard/index.js') }}"></script>

@endsection
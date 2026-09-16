@php
    $total = (int) $total;
    $perPage = (int) $perPage;
    $page = (int) $page;

    $totalPages = $perPage > 0
        ? (int) ceil($total / $perPage)
        : 0;

    $range = 2;

    /*
    |--------------------------------------------------------------------------
    | Query String
    |--------------------------------------------------------------------------
    */

    $queryParams = [
        'perPage' => $perPage,
    ];
@endphp


<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-4">

    <!-- Total -->
    <div>
        <strong>Total Users:</strong>

        <span class="badge bg-primary fs-6">
            {{ $total }}
        </span>
    </div>


    <!-- Records Per Page -->
    <div>

        <label for="perPage" class="form-label mb-0">
            Records per page:
        </label>

        <select
            id="perPage"
            class="form-select form-select-sm d-inline-block"
            style="width: 100px;"
            onchange="changePerPage(this.value)"
        >

            @foreach ([5, 10, 20, 50, 100] as $limit)

                <option
                    value="{{ $limit }}"
                    {{ $perPage == $limit ? 'selected' : '' }}
                >
                    {{ $limit }}
                </option>

            @endforeach

        </select>

    </div>


    <!-- Pagination -->
    <nav aria-label="User pagination">

        <ul class="pagination mb-0">

            <!-- Previous -->
            @if ($page > 1)

                <li class="page-item">

                    <a
                        class="page-link"
                        href="{{ url('admin/index') . '?' . http_build_query([
                            'page' => $page - 1,
                            'perPage' => $perPage,
                        ]) }}"
                    >
                        Previous
                    </a>

                </li>

            @else

                <li class="page-item disabled">

                    <span class="page-link">
                        Previous
                    </span>

                </li>

            @endif


            <!-- First Page -->
            @if ($page > $range + 1)

                <li class="page-item">

                    <a
                        class="page-link"
                        href="{{ url('admin/index') . '?' . http_build_query([
                            'page' => 1,
                            'perPage' => $perPage,
                        ]) }}"
                    >
                        1
                    </a>

                </li>


                @if ($page > $range + 2)

                    <li class="page-item disabled">

                        <span class="page-link">
                            ...
                        </span>

                    </li>

                @endif

            @endif


            <!-- Page Numbers -->

            @php
                $startPage = max(1, $page - $range);
                $endPage = min($totalPages, $page + $range);
            @endphp


            @for ($i = $startPage; $i <= $endPage; $i++)

                <li class="page-item {{ $i == $page ? 'active' : '' }}">

                    <a
                        class="page-link"
                        href="{{ url('admin/index') . '?' . http_build_query([
                            'page' => $i,
                            'perPage' => $perPage,
                        ]) }}"
                    >
                        {{ $i }}
                    </a>

                </li>

            @endfor


            <!-- Last Page -->

            @if ($page < $totalPages - $range)

                @if ($page < $totalPages - $range - 1)

                    <li class="page-item disabled">

                        <span class="page-link">
                            ...
                        </span>

                    </li>

                @endif


                <li class="page-item">

                    <a
                        class="page-link"
                        href="{{ url('admin/index') . '?' . http_build_query([
                            'page' => $totalPages,
                            'perPage' => $perPage,
                        ]) }}"
                    >
                        {{ $totalPages }}
                    </a>

                </li>

            @endif


            <!-- Next -->

            @if ($page < $totalPages)

                <li class="page-item">

                    <a
                        class="page-link"
                        href="{{ url('admin/index') . '?' . http_build_query([
                            'page' => $page + 1,
                            'perPage' => $perPage,
                        ]) }}"
                    >
                        Next
                    </a>

                </li>

            @else

                <li class="page-item disabled">

                    <span class="page-link">
                        Next
                    </span>

                </li>

            @endif


            <!-- Last -->

            @if ($page < $totalPages)

                <li class="page-item">

                    <a
                        class="page-link"
                        href="{{ url('admin/index') . '?' . http_build_query([
                            'page' => $totalPages,
                            'perPage' => $perPage,
                        ]) }}"
                    >
                        Last
                    </a>

                </li>

            @endif

        </ul>

    </nav>

</div>


<!-- Record Count -->

@php
    $startRecord = (($page - 1) * $perPage) + 1;
    $endRecord = min($page * $perPage, $total);
@endphp


<div class="text-muted mt-2">

    @if ($total > 0)

        Showing {{ $startRecord }}
        to {{ $endRecord }}
        of {{ $total }} users

    @else

        No users found

    @endif

</div>


<script>
    function changePerPage(limit) {

        const url = new URL('{{ url('admin/index') }}', window.location.origin);

        url.searchParams.set('page', 1);
        url.searchParams.set('perPage', limit);

        window.location.href = url.toString();
    }
</script>
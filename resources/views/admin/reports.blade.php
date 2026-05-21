@extends('admin.layout.master')
@section('title', 'Report')

@section('content')

<!-- Main Workspace Area -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <!-- Header Top Bar -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">USERS LIKE REPORT</h1>
    </div>

    <!-- Structured Data Table -->
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase fs-7 text-muted">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email Address</th>
                    <th scope="col" class="text-center">Most Like Car Brand</th>
                    <th scope="col" class="text-center">Most Like Car Model</th>
                    <th scope="col" class="text-center">Most Like Car Type</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                <div class="fw-semibold">{{ $user->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                <div class="text-muted small">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center"><span class="">{{ $user->brand }}{{ $user->brand === '' ? 'N/A' : '' }}</span></td>
                    <td class="text-center"><span class="">{{ $user->model }}{{ $user->model === '' ? 'N/A' : '' }}</span></td>
                    <td class="text-center"><span class="">{{ $user->type }}{{ $user->type === '' ? 'N/A' : '' }}</span></td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
    <!-- Pagination Footer Bar -->
    <div class="card-footer bg-white py-3 d-flex justify-content-between align-items-center">
        <span class="text-muted small">Showing 1 to {{ $total }} of {{ $total }} entries</span>
        <nav aria-label="Table Navigation">
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-item link-secondary page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</main>

@stop

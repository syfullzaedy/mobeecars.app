@extends('admin.layout.master')
@section('title', 'Users')

@section('content')

<!-- Main Workspace Area -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <!-- Header Top Bar -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users List</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <a href="{{ route('add_user') }}"><button type="button" class="btn btn-sm btn-primary">Add New User</button></a>
        </div>
    </div>

    <!-- Structured Data Table -->
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase fs-7 text-muted">
                <tr>
                    <th scope="col" style="width: 50px;" class="ps-4">
                        <input class="form-check-input" type="checkbox">
                    </th>
                    <th scope="col">User Details</th>
                    <th scope="col" class="text-center">Most Like Car Brand</th>
                    <th scope="col" class="text-center">Most Like Car Model</th>
                    <th scope="col" class="text-center">Most Like Car Type</th>
                    <th scope="col" class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                    <td class="ps-4"><input class="form-check-input" type="checkbox"></td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                <div class="fw-semibold">{{ $user->name }}</div>
                                <div class="text-muted small">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center"><span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">{{ $user->brand }}{{ $user->brand === '' ? 'N/A' : '' }}</span></td>
                    <td class="text-center"><span class="badge bg-success-subtle text-success border border-success-subtle">{{ $user->model }}{{ $user->model === '' ? 'N/A' : '' }}</span></td>
                    <td class="text-center"><span class="badge bg-danger-subtle text-danger border border-danger-subtle">{{ $user->type }}{{ $user->type === '' ? 'N/A' : '' }}</span></td>
                    <td class="text-end pe-4">
                        <div class="btn-group">
                            <a href="{{ route('get_user', ['id' => $user->id]) }}"><button class="btn btn-sm btn-light border text-primary" title="View Details"><i class="bi bi-file-text"></i></button></a>

                            <a href="{{ route('edit_user', ['id' => $user->id]) }}"><button class="btn btn-sm btn-light border" title="Edit"><i class="bi bi-pencil"></i></button></a>
                            <form class="" action="{{ route('delete_user', ['id' => $user->id]) }}" method="post">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-light border text-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this item?')"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
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

@extends('admin.layout.master')
@section('title', 'Users')

@section('content')

<!-- Main Workspace Area -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <!-- Breadcrumbs and Action Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('get_users') }}" class="text-decoration-none">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New User</li>
                </ol>
            </nav>
            <h1 class="h3">Create New User</h1>
        </div>
        <a href="{{ route('get_users') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    <!-- Form Card Wrapper -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4 p-md-5">

            <!-- Submission Form (Native Bootstrap Validation Class Attached) -->
            <form class="needs-validation" action="{{ route('add_user') }}" enctype="multipart/form-data" method="post">

                <!-- Row 1: Profile Summary Basics -->
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-12">
                        <label for="firstName" class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" value="{{ old('name') }}{{ $user->name ?? '' }}" required>
                        <input type="hidden" name="id" value="{{ old('id') }}{{ $user->id ?? '' }}">
                        <div class="invalid-feedback">Please enter a name.</div>
                    </div>
                </div>

                <!-- Row 2: Communication Data -->
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6">
                        <label for="userEmail" class="form-label fw-semibold">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope text-muted"></i></span>
                            <input type="email" name="email" class="form-control" id="email" placeholder="j.doe@company.com" value="{{ old('email') }}{{ $user->email ?? '' }}" required>
                            <div class="invalid-feedback">Please provide a valid email address.</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="userPassword" class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock text-muted"></i></span>
                            <input type="password" name="password" class="form-control" id="password"  minlength="8">
                            <div class="invalid-feedback">Password must contain at least 8 elements.</div>
                        </div>
                    </div>
                </div>

                <hr class="my-4 text-secondary opacity-25">

                @if($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center;">
                  {{ $error }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
                @endif

                <!-- Submission Action Triggers -->
                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-light border px-4">Clear Form</button>
                    <button type="submit" class="btn btn-primary px-5">Save</button>
                </div>

            </form>

        </div>
    </div>
</main>

@stop

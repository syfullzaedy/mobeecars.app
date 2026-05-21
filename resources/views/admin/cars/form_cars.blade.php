@extends('admin.layout.master')
@section('title', 'Cars')

@section('content')

<!-- Main Workspace Area -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <!-- Breadcrumbs and Action Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('get_cars') }}" class="text-decoration-none">Cars</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Car</li>
                </ol>
            </nav>
            <h1 class="h3">Create New Car</h1>
        </div>
        <a href="{{ route('get_cars') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    <!-- Form Card Wrapper -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4 p-md-5">

            <!-- Submission Form (Native Bootstrap Validation Class Attached) -->
            <form class="needs-validation" action="{{ route('add_car') }}" enctype="multipart/form-data" method="post">
                <div class="display-flex align-items-center justify-content-center row g-3 mb-4">
                  <div class="col-12 col-md-12 text-center">
                    <img src="{{ $car->image_64 ?? '' }}" alt="" width="320px">
                  </div>
                </div>

                <!-- Row 1: Profile Summary Basics -->
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6">
                        <label for="firstName" class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Car Name" value="{{ old('name') }}{{ $car->name ?? '' }}" required>
                        <input type="hidden" name="id" value="{{ old('car_id') }}{{ $car->car_id ?? '' }}">
                        <div class="invalid-feedback">Please enter a car name.</div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="firstName" class="form-label fw-semibold">Type</label>
                        <select class="form-control" name="type">
                        <option value=""></option>
                          @foreach ($types as $type)
                          <option value="{{ $type->type_id ?? '' }}" {{ $type->type_id === $car->type_id ? 'selected' : '' }}>{{ $type->name }}</option>
                          @endforeach
                        </select>
                        <div class="invalid-feedback">Please enter a car type.</div>
                    </div>
                </div>

                <!-- Row 2: Communication Data -->
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6">
                        <label for="firstName" class="form-label fw-semibold">Brand</label>
                        <select class="form-control" name="brand">
                        <option value=""></option>
                          @foreach ($brands as $brand)
                          <option value="{{ $brand->brand_id }}" {{ $brand->brand_id === $car->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                          @endforeach
                        </select>
                        <div class="invalid-feedback">Please enter a car name.</div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="firstName" class="form-label fw-semibold">Model</label>
                        <select class="form-control" name="model">
                        <option value=""></option>
                          @foreach ($models as $model)
                          <option value="{{ $model->model_id }}" {{ $model->model_id === $car->model_id ? 'selected' : '' }}>{{ $model->name }}</option>
                          @endforeach
                        </select>
                        <div class="invalid-feedback">Please enter a car model.</div>
                    </div>
                </div>

                <!-- Row 2: Communication Data -->
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6">
                        <label for="firstName" class="form-label fw-semibold">Picture</label>
                        <input class="form-control" type="file" name="picture" value="">
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

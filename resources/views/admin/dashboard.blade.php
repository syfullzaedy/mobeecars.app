@extends('admin.layout.master')
@section('title', 'Dashboard')

@section('content')

<!-- Main Workspace Area -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <!-- Header Top Bar -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard Overview</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>

    <!-- Analytical Visual Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="text-muted small">Most Like Car Brand</div>
                <div class="fs-3 fw-bold">{{ $stats_brand }}</div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="text-muted small">Most Like Car Model</div>
                <div class="fs-3 fw-bold">{{ $stats_model }}</div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="text-muted small">Most Like Car Type</div>
                <div class="fs-3 fw-bold">{{ $stats_type }}</div>
            </div>
        </div>
    </div>
</main>

@stop

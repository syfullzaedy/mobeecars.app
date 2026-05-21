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
                  <li class="breadcrumb-item active" aria-current="page">User Details</li>
              </ol>
          </nav>
          <h1 class="h3">User Profile: {{ $user->name ?? '' }}</h1>
      </div>
      <a href="{{ route('get_users') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
          <i class="bi bi-arrow-left"></i> Back to List
      </a>
  </div>

  <!-- Two-Column Master/Detail Layout Grid -->
  <div class="row g-4">


      <div class="col-12 col-lg-4">
          <div class="card border-0 shadow-sm text-center p-4">
              <h4 class="mb-1">{{ $user->name ?? '' }}</h4>
              <p class="text-muted small mb-3">System User</p>
              <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill mb-4">Active</span>

              <div class="text-start border-top pt-3">
                  <div class="mb-2"><span class="text-muted small d-block">Email Address</span><span class="fw-semibold">{{ $user->email ?? '' }}</span></div>
                  <div><span class="text-muted small d-block">Joined System</span><span class="fw-semibold">{{ $user->custom_datetime ?? '' }}</span></div>
              </div>
          </div>
      </div>

      <!-- Right Workspace Panel: Contextual Navigation Tabs -->
      <div class="col-12 col-lg-8">
          <div class="card border-0 shadow-sm">
              <div class="card-header bg-white border-bottom-0 pt-3">
                  <!-- Nav Tabs Controls -->
                  <ul class="nav nav-tabs card-header-tabs" id="profileTab" role="tablist">
                      <li class="nav-item">
                          <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">Likes Overview</button>
                      </li>
                      <li class="nav-item">
                          <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab">Recent Like Activities</button>
                      </li>
                  </ul>
              </div>

              <div class="card-body tab-content p-4" id="profileTabContent">
                  <!-- Tab 1: Detailed Metadata Overview -->
                  <div class="tab-pane fade show active" id="overview" role="tabpanel">
                      <h5 class="mb-3">Most Like Summary</h5>
                      <div class="row g-3 mb-4">
                          <div class="col-4"><div class="p-3 bg-light rounded"><span class="text-muted small d-block">Most Like Car Brand</span><strong>{{ $user->brand ?? '' }}</strong></div></div>
                          <div class="col-4"><div class="p-3 bg-light rounded"><span class="text-muted small d-block">Most Like Car Model</span><strong>{{ $user->model ?? '' }}</strong></div></div>
                          <div class="col-4"><div class="p-3 bg-light rounded"><span class="text-muted small d-block">Most Like Car Type</span><strong>{{ $user->type ?? '' }}</strong></div></div>
                      </div>
                  </div>

                  <!-- Tab 2: Security & Interactive Timelines -->
                  <div class="tab-pane fade" id="security" role="tabpanel">
                      <ul class="timeline-steps ms-3">
                        @foreach ($user?->activities as $activity)
                          <li class="timeline-item mb-3">
                              <div class="fw-semibold text-dark">Liked {{ $activity->car }}</div>
                              <span class="text-muted small">{{ $activity->custom_datetime }}</span>
                          </li>
                        @endforeach
                      </ul>
                  </div>
              </div>

          </div>
      </div>

  </div>
</main>

@stop

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body { background-color: #f8f9fa; }
        .login-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { border: none; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
    </style>
  </head>
  <body>
    <div class="container login-container">
      <div class="row justify-content-center w-100">
        <div class="col-md-6 col-lg-5">
          <div class="card p-4">
            <div class="card-body">
              <h3 class="card-title text-center mb-4">Login</h3>
              <form class="" action="{{ route('post_login') }}" method="post" enctype="multipart/form-data" >
                @csrf
                <!-- Email Input -->
                <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                </div>
                <!-- Password Input -->
                <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                </div>
                <!-- Submit Button -->
                <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
                </div>
              </form>
              <br>
              @if($errors->any())
              @foreach ($errors->all() as $error)
              <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center;">
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

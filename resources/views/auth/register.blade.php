<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dusun Wayang Karangwatu - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/sb/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="/sb/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

</head>

<body class="bg-gradient">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="post" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" placeholder="Nama Lengkap">
                  @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" id="exampleInputEmail" placeholder="Email Address">
                  @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="input-group">
                      <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" id="exampleInputPassword" placeholder="Password">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye"></i></button>
                      </div>
                    </div>
                    @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="col-sm-6">
                    <div class="input-group">
                      <input type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="exampleRepeatPassword" placeholder="Repeat Password">
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword"><i class="fas fa-eye"></i></button>
                      </div>
                    </div>
                    @error('password_confirmation')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>
                <button type="submit" class="btn text-light btn-user btn-block" style="background-color: #d97706;" onmouseover="this.style.backgroundColor='#b45309';" onmouseout="this.style.backgroundColor='#d97706';">
                  Login
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="/forgot-password">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="/login">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="/sb/vendor/jquery/jquery.min.js"></script>
  <script src="/sb/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/sb/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/sb/js/sb-admin-2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#togglePassword').click(function() {
        var passwordInput = $('#exampleInputPassword');
        var toggleButton = $(this);
        if (passwordInput.attr('type') === 'password') {
          passwordInput.attr('type', 'text');
          toggleButton.find('i').removeClass('fas fa-eye').addClass('fas fa-eye-slash');
        } else {
          passwordInput.attr('type', 'password');
          toggleButton.find('i').removeClass('fas fa-eye-slash').addClass('fas fa-eye');
        }
      });

      $('#toggleConfirmPassword').click(function() {
        var confirmPasswordInput = $('#exampleRepeatPassword');
        var toggleButton = $(this);
        if (confirmPasswordInput.attr('type') === 'password') {
          confirmPasswordInput.attr('type', 'text');
          toggleButton.find('i').removeClass('fas fa-eye').addClass('fas fa-eye-slash');
        } else {
          confirmPasswordInput.attr('type', 'password');
          toggleButton.find('i').removeClass('fas fa-eye-slash').addClass('fas fa-eye');
        }
      });
    });
  </script>
</body>

</html>
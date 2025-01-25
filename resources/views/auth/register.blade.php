<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/application-default/css/custom-log-reg.css') }}">
    <title>REGISTER|SIGNUP</title>
  </head>
  <body>
    <div class="form-wrap">
        <div class="login-card">
            <div class="logo text-center">
                <img src="{{ asset('assets/application-default/img/login-logo.png') }}" alt="" class="img-fluid">
            </div>
            <div class="login-child  p-4">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="name" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
                        @error('password')
                            <strong class="invalid-feedback" role="alert">
                                {{ $message }}
                            </strong>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password-confirm" class="form-control @error('password_confirmation') is-invalid @enderror" autocomplete="new-password">
                    </div>
                    <div class="forgot-login">
                        <div class="forgot">
                            <a href="{{ route('login') }}">Already Registered?</a>
                        </div>
                        <div class="login">
                            <button type="submit" class="btn btn-cutom">
                                REGISTER
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            let email = $('#email').val();
            let password = $('#password').val();

            let errro = false;

            if(email = ''){
                errro = true;

                $('.email_group .invalid-feedback strong').text('The email field is required');
            }

        });
    </script>
  </body>
</html>
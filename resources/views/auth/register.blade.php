<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

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
                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" class="form-control form-control-user" type="name" name="name" :value="old('name')" required autocomplete="username" placeholder="Name"/>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control form-control-user" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email Address"/>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <x-input-label for="password" :value="__('Password')" />

                                        <x-text-input id="password" class="form-control form-control-user"
                                                        type="password"
                                                        placeholder="Password"
                                                        name="password"
                                                        required autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                        <x-text-input id="password_confirmation" class="form-control form-control-user"
                                                        type="password"
                                                        placeholder="Repeat Password"
                                                        name="password_confirmation" required autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>
                                <x-primary-button class="btn btn-primary btn-user btn-block">
                                    {{ __('Register') }}
                                </x-primary-button>
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{route ('password.request')}}">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{route ('login')}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>

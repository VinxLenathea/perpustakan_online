<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Custom fonts -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Custom styles -->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            background: url("assets/img/bg1.jpg") no-repeat center center fixed;
            background-size: cover;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height:100vh;">
            <div class="col-lg-5">
                <div class="card shadow-lg my-5">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h1 class="h4 text-gray-900">Login</h1>
                        </div>

                        <!-- Form Login -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control"
                                    type="email" name="email" :value="old('email')" required autofocus
                                    placeholder="Enter Email Address" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="form-control"
                                    type="password" name="password" required
                                    placeholder="Enter Password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <x-primary-button class="btn btn-primary btn-block">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts -->
    <script src="assets/js/sb-admin-2.min.js"></script>
</body>

</html>

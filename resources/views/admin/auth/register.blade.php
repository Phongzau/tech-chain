@extends('admin.auth.layouts.master')

@section('content')
    <div class="account-page">
        <div class="container-fluid p-0">
            <div class="row align-items-center g-0">
                <div class="col-xl-5">
                    <div class="row">
                        <div class="col-md-7 mx-auto">
                            <div class="mb-0 border-0 p-md-5 p-lg-0 p-4">
                                <div class="mb-4 p-0">
                                    <a class='auth-logo' href='index.html'>
                                        <img src="assets/images/logo-dark.png" alt="logo-dark" class="mx-auto"
                                            height="28" />
                                    </a>
                                </div>

                                <div class="pt-0">
                                    <form action="{{ route('register') }}" method="POST" class="my-4">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input id="name" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" type="text" id="username"
                                                placeholder="Enter your Username" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-group mb-3">
                                            <label for="emailaddress" class="form-label">Email address</label>
                                            <input id="email" class="form-control @error('email') is-invalid @enderror"
                                                type="email" id="emailaddress" name="email" value="{{ old('email') }}"
                                                autocomplete="email" placeholder="Enter your email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-group mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                type="password" id="password" name="password" autocomplete="new-password"
                                                placeholder="Enter your password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-group mb-3">
                                            <label for="password" class="form-label">Confirm Password</label>
                                            <input class="form-control" type="password" id="password-confirm"
                                                name="password_confirmation" autocomplete="new-password"
                                                placeholder="Confirm your password">
                                        </div>

                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary" type="submit"> Register</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="saprator my-4"><span>or sign in with</span></div>

                                    <div class="text-center text-muted mb-4">
                                        <p class="mb-0">Already have an account ?<a class='text-primary ms-2 fw-medium'
                                                href='{{ route('admin.login') }}'>Login here</a></p>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7">
                    <div class="account-page-bg p-md-5 p-4">
                        <div class="text-center">
                            <h3 class="text-dark mb-3 pera-title">Quick, Effective, and Productive With Tapeli Admin
                                Dashboard</h3>
                            <div class="auth-image">
                                <img src="assets/images/authentication.svg" class="mx-auto img-fluid" alt="images">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

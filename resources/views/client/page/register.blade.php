@extends('client.page.template')
@section('body')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Error!</strong> {{ session('error') }}
        </div>
    @endif
    <section class="">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="{{ route('handleRegister') }}" method="post">
                        {{ csrf_field() }}

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Register</p>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Enter username" name="user_name" value="{{ old('user_name') }}" />
                        </div>

                        <div class="form-outline mb-4">
                            <input type="email" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Enter a valid email address" name="user_email" value="{{ old('user_email') }}"/>
                        </div>

                        <div class="form-outline mb-3">
                            <input type="text" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Enter phone number" name="user_phone" value="{{ old('user_phone') }}"/>
                        </div>

                        <div class="form-outline mb-3">
                            <input type="text" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Enter address" name="user_address" value="{{ old('user_address') }}"/>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Enter password" name="user_password" />
                        </div>


                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Enter password" name="user_repassword"/>
                        </div>

                        {{-- <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                            </div>
                            <a href="#!" class="text-body">Forgot password?</a>
                        </div> --}}

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Have an account? <a href={{route('login')}}
                                    class="link-danger">Login</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }

        button {
            background: black !important;
        }
    </style>
@endsection

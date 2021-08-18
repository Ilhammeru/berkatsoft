@extends('layout.app')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endpush
@section('content')
<div class="row-login mx-auto">
    <div class="card card-login">
        <div class="card-body card-body-login">
            <div class="card-header header-login">
                <h4 class="text-muted">
                    Login Form                    
                </h4>
            </div>
            <div class="card-body">
                <div class="login">
                    <form id="form-login">
                        @csrf
                        <div class="form-group text-center">
                            <span>Please login first</span>
                        </div>
                        <div class="form-group mt-3" style="text-align: -webkit-center">
                            <input autocomplete="off" type="text" placeholder="username" class="form-control form-control-md username-login" name="username">
                            <div class="invalid-feedback error-username-login"></div>
                        </div>
                        <div class="form-group mt-3" style="text-align: -webkit-center">
                            <input type="password" autocomplete="off" placeholder="password" class="form-control form-control-md password-login" name="password">
                            <div class="invalid-feedback error-password-login"></div>
                        </div>
                        <div class="form-group mt-4 text-center">
                            <button type="submit" class="btn btn-primary button-save">Login</button>
                        </div>
                    </form>
    
                    <div class="row mt-5">
                        <div class="col">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <span class="span-forgot">
                                        <i>Forgot Password?</i>
                                    </span>
                                </div>
                                <div>
                                    <span class="span-register">
                                        <i>Register Here</i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- register --}}
                <div class="register d-none">
                    <form action="" id="form-register">
                        <div class="form-group text-center">
                            <span>Create Account</span>
                        </div>
                        <div class="form-group mt-3" style="text-align: -webkit-center">
                            <input autocomplete="off" type="text" placeholder="username" class="form-control form-control-md username-register" name="username">
                            <div class="invalid-feedback error-username-register"></div>
                        </div>
                        <div class="form-group mt-3" style="text-align: -webkit-center">
                            <input autocomplete="off" type="email" placeholder="john@doe.com" class="form-control form-control-md email-register" name="email">
                            <div class="invalid-feedback error-email-register"></div>
                        </div>
                        <div class="form-group mt-3" style="text-align: -webkit-center">
                            <input type="password" autocomplete="off" placeholder="password" class="form-control form-control-md password-register" name="password">
                            <div class="invalid-feedback error-password-register"></div>
                        </div>
                        <div class="form-group mt-4 text-center">
                            <button type="submit" class="btn btn-primary button-save">Register</button>
                        </div>
                    </form>

                    <div class="row mt-5">
                        <div class="col">
                            <div class="d-flex justify-content-between">
                                <div>
                                </div>
                                <div>
                                    <span class="span-login">
                                        Already have account ? Login <i>Here</i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/login.js') }}"></script>
@endsection
@extends('layout.app')

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
    <div class="container-fluid">
        <a class="navbar-brand">BerkatSoft</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @if(Session::get('role') == "admin")
                <li class="nav-item">
                    <a style="cursor: pointer;" class="nav-link navs active" data-target="customer">Customer</a>
                </li>
                <li class="nav-item">
                    <a style="cursor: pointer;" class="nav-link navs" data-target="product">Product</a>
                </li>
            @endif
            <li class="nav-item">
                <a style="cursor: pointer;" class="nav-link navs {{ (Session::get('role') != 'admin') ? "active" : "" }}" data-target="sales">Sales</a>
            </li>
        </ul>
        <form class="d-flex">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a style="cursor: pointer;" class="nav-link">
                        <span class="text-muted" style="margin-right: 0.7em;">{{ Session::get('email') }}</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a style="cursor: pointer;" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/user.png') }}" style="width: 1.5em; height: auto;" alt="">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="margin-left: -7em;">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </form>
        </div>
    </div>
</nav>
@endsection

@section('content')
@include('index')
@endsection
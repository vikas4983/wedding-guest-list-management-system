@extends('layouts.main-app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <!-- Frist box -->
        <div class="col-xl-3 col-md-6">
            <a href="{{route('guests.index')}}">
                <div class="card card-default bg-secondary">
                    <div class="d-flex p-5">
                        <div class="icon-md bg-white rounded-circle mr-3">
                            <i class="mdi mdi-shape text-secondary"></i>
                        </div>
                        <div class="text-left">
                            <span class="h2 d-block text-white"></span>
                            <p class="text-white">Guests</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Second box -->
        <div class="col-xl-3 col-md-6">
            <a href="#">
                <div class="card card-default bg-success">
                    <div class="d-flex p-5">
                        <div class="icon-md bg-white rounded-circle mr-3">
                            <i class="mdi mdi-label text-success"></i>
                        </div>
                        <div class="text-left">
                            <span class="h2 d-block text-white"></span>
                            <p class="text-white">Brands</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Third box -->
        <div class="col-xl-3 col-md-6">
            <a href="#">
                <div class="card card-default bg-primary">
                    <div class="d-flex p-5">
                        <div class="icon-md bg-white rounded-circle mr-3">
                            <i class="mdi mdi-palette text-primary"></i>
                        </div>
                        <div class="text-left">
                            <span class="h2 d-block text-white"></span>
                            <p class="text-white">Products</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Fourth box -->
        <div class="col-xl-3 col-md-6">
            <a href="#">
                <div class="card card-default bg-info">
                    <div class="d-flex p-5">
                        <div class="icon-md bg-white rounded-circle mr-3">
                            <i class="mdi mdi-package-variant text-info"></i>
                        </div>
                        <div class="text-left">
                            <span class="h2 d-block text-white"></span>
                            <p class="text-white">Suppliers</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <!-- Frist box -->
        <div class="col-xl-3 col-md-6">
            <a href="#">
                <div class="card card-default bg-secondary">
                    <div class="d-flex p-5">
                        <div class="icon-md bg-white rounded-circle mr-3">
                            <i class="mdi mdi-account-multiple text-secondary"></i>
                        </div>
                        <div class="text-left">
                            <span class="h2 d-block text-white"></span>
                            <p class="text-white">Customers</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Second box -->
        <div class="col-xl-3 col-md-6">
            <a href="#">
                <div class="card card-default bg-success">
                    <div class="d-flex p-5">
                        <div class="icon-md bg-white rounded-circle mr-3">
                            <i class="mdi mdi-clock-outline text-success"></i>
                        </div>
                        <div class="text-left">
                            <span class="h2 d-block text-white"></span>
                            <p class="text-white">Statuses</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Third box -->
        <div class="col-xl-3 col-md-6">
            <a href="#">
                <div class="card card-default bg-primary">
                    <div class="d-flex p-5">
                        <div class="icon-md bg-white rounded-circle mr-3">
                            <i class="mdi mdi-cart text-primary"></i>
                        </div>
                        <div class="text-left">
                            <span class="h2 d-block text-white"></span>
                            <p class="text-white">Purchases</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Fourth box -->
        <div class="col-xl-3 col-md-6">
            <a href="#">
                <div class="card card-default bg-info">
                    <div class="d-flex p-5">
                        <div class="icon-md bg-white rounded-circle mr-3">
                            <i class="mdi mdi-cart-plus text-info"></i>
                        </div>
                        <div class="text-left">
                            <span class="h2 d-block text-white"></span>
                            <p class="text-white">Purchase Items</p>
                        </div>
                    </div>
                </div>
        </div></a>
    </div>
    <div class="row">
        <!-- Frist box -->
        <div class="col-xl-3 col-md-6">
            <a href="#">
                <div class="card card-default bg-secondary">
                    <div class="d-flex p-5">
                        <div class="icon-md bg-white rounded-circle mr-3">
                            <i class="mdi mdi-chart-line text-secondary"></i>
                        </div>
                        <div class="text-left">
                            <span class="h2 d-block text-white"></span>
                            <p class="text-white">Sales</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Second box -->
        <div class="col-xl-3 col-md-6">
            <a href="#">
                <div class="card card-default bg-success">
                    <div class="d-flex p-5">
                        <div class="icon-md bg-white rounded-circle mr-3">
                            <i class="mdi mdi-clock-outline text-success"></i>
                        </div>
                        <div class="text-left">
                            <span class="h2 d-block text-white"></span>
                            <p class="text-white">Sale Items</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection

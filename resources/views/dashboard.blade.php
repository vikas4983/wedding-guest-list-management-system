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
                            <span class="h2 d-block text-white">500</span>
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
                            <span class="h2 d-block text-white">100</span>
                            <p class="text-white">Events</p>
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
                            <span class="h2 d-block text-white">100</span>
                            <p class="text-white">Lagun Guests</p>
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
                            <span class="h2 d-block text-white">100</span>
                            <p class="text-white">Mandap</p>
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
                            <span class="h2 d-block text-white">100</span>
                            <p class="text-white">Haldi</p>
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
                            <span class="h2 d-block text-white">100</span>
                            <p class="text-white">Barat</p>
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
                            <span class="h2 d-block text-white">100</span>
                            <p class="text-white">Reception Party</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Fourth box -->
        
    </div>
    
@endsection

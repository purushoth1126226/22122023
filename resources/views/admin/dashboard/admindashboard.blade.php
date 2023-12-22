@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="DASHBOARD" />
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </x-admin.layouts.adminbreadcrumb>





    {{-- <div class="card mx-auto border-0" style="background: #f1f5f9;">
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col">
                    <a href="{{ route('adminproduct') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Total Model</h5>
                                <hr>
                                <h2 class="card-text">{{ $model }}</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('adminproduct') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Total Enquired</h5>
                                <hr>
                                <h2 class="card-text">{{ $enquired }}</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('adminproduct') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Total Sold</h5>
                                <hr>
                                <h2 class="card-text">{{ $sold }}</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('adminpartner') }}" class="text-decoration-none text-dark text-center">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Total Financing Partner</h5>
                                <hr>
                                <h2 class="card-text">{{ $financingpartner }}</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}
@endsection


@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#admindashboard_sidenav',
    ])
@endsection

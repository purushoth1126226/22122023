@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('adminnavbar')
    <x-admin.layouts.adminnavbar modulename="{{ __('STOCK HISTORY') }}" />
@endsection

@section('main-content')
    <x-admin.layouts.adminbreadcrumb>
        <li class="breadcrumb-item"><a wire:navigate class="text-decoration-none"
                href="{{ route('adminstockadjustment') }}">{{ __('Stockadjustment') }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Stockhistory') }}</li>
    </x-admin.layouts.adminbreadcrumb>

    @livewire('admin.product.stock.stockhistorylivewire', ['id' => $id])
@endsection

@section('footerSection')
    @include('helper.sidenavhelper.sidenavactive', [
        'type' => 1,
        'nameone' => '#adminproduct_sidenav',
    ])
@endsection

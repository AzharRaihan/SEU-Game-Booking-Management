@extends('layouts.backend.backend-layouts')
@section('title', 'Dashboard')
@push('css')
@endpush
@section('page-content')
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-title-box text-muted">
                    <h4 class="page-title float-left"><span><i class="icon-grid"></i></span> Dashboard</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Game Room</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-people float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Member Request</h6>
                    <h2 class="m-b-20" data-plugin="counterup">{{ $users }}</h2>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-game-controller float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Available Games</h6>
                    <h2 class="m-b-20" data-plugin="counterup">{{ $games }}</h2>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container -->
</div> <!-- content --> 
@endsection
@push('js')
@endpush
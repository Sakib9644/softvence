@extends('backend.layouts.master')

@section('content')



<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col">
                    <div class="h-100">
                        <div class="row mb-3 pb-1">
                            <div class="col-12">
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-16 mb-1">{{ auth()->user()->name }}</h4>
                                        <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Static Quick Links with Zoom Effect -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <a href="#" class="card text-center h-100 shadow-sm text-decoration-none zoom-hover">
                                    <div class="card-body">
                                        <i class="ri-upload-2-line fs-2 text-primary mb-2"></i>
                                        <h6 class="mb-0 text-dark">Product Upload</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <a href="#" class="card text-center h-100 shadow-sm text-decoration-none zoom-hover">
                                    <div class="card-body">
                                        <i class="ri-folder-upload-line fs-2 text-primary mb-2"></i>
                                        <h6 class="mb-0 text-dark">Category Upload</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <a href="#" class="card text-center h-100 shadow-sm text-decoration-none zoom-hover">
                                    <div class="card-body">
                                        <i class="ri-file-list-line fs-2 text-primary mb-2"></i>
                                        <h6 class="mb-0 text-dark">Manage Orders</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <a href="#" class="card text-center h-100 shadow-sm text-decoration-none zoom-hover">
                                    <div class="card-body">
                                        <i class="ri-user-line fs-2 text-primary mb-2"></i>
                                        <h6 class="mb-0 text-dark">Customer List</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <a href="#" class="card text-center h-100 shadow-sm text-decoration-none zoom-hover">
                                    <div class="card-body">
                                        <i class="ri-bar-chart-line fs-2 text-primary mb-2"></i>
                                        <h6 class="mb-0 text-dark">Reports</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <a href="#" class="card text-center h-100 shadow-sm text-decoration-none zoom-hover">
                                    <div class="card-body">
                                        <i class="ri-settings-3-line fs-2 text-primary mb-2"></i>
                                        <h6 class="mb-0 text-dark">Settings</h6>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

   
</div>

@endsection

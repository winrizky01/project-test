@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                </div>

                {{-- <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-9 col-9">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Patient Queue Information</h3>
                            </div>
                            <div class="card-body text-center">
                                <h1 class="mb-1">Current Queue Number</h1>
                                <div class="display-4">A-{{ $antrian_saat_ini }}</div>
                                <p class="lead">Status: <span class="badge badge-success">In Progress</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3">
                        <div class="row mt-1">
                            <div class="col-lg-12 col-12">
                                <!-- small box -->
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                        <h3>{{ $antrian_saat_ini }}</h3>
                                        <p>Antrian Saat Ini</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-12 col-12">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ $total_antrian }}</h3>
                                        <p>Jumlah Antrian</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <!-- /.row -->
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-9 col-9">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Patient Queue Information</h3>
                            </div>
                            <div class="card-body text-center">
                                <h1 class="mb-1">Current Queue Number</h1>
                                <div class="display-4">B-{{ $antrian_saat_ini }}</div>
                                <p class="lead">Status: <span class="badge badge-success">In Progress</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3">
                        <div class="row mt-1">
                            <div class="col-lg-12 col-12">
                                <!-- small box -->
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                        <h3>{{ $antrian_saat_ini }}</h3>
                                        <p>Antrian Saat Ini</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-12 col-12">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ $total_antrian }}</h3>
                                        <p>Jumlah Antrian</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <!-- /.row -->
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-9 col-9">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Patient Queue Information</h3>
                            </div>
                            <div class="card-body text-center">
                                <h1 class="mb-1">Current Queue Number</h1>
                                <div class="display-4">C-{{ $antrian_saat_ini }}</div>
                                <p class="lead">Status: <span class="badge badge-success">In Progress</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3">
                        <div class="row mt-1">
                            <div class="col-lg-12 col-12">
                                <!-- small box -->
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                        <h3>{{ $antrian_saat_ini }}</h3>
                                        <p>Antrian Saat Ini</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-12 col-12">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ $total_antrian }}</h3>
                                        <p>Jumlah Antrian</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <!-- /.row --> --}}
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

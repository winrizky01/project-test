@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- toast notification -->
        {{-- @if (session('error'))
        <div id="toastsContainerTopRight" class="toasts-top-right fixed">
            <div class="toast bg-warning fade show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="mr-auto">Warning</strong>
                    <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="toast-body">{{session('error')}}</div>
            </div>
        </div> --}}
        @if (session('success'))
        <div id="toastsContainerTopRight" class="toasts-top-right fixed">
            <div class="toast bg-success fade show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="mr-auto"> Success</strong>
                    <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="toast-body">{{session('success')}}</div>
            </div>
        </div>
        @endif
        <!-- /.toast notification -->

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $card_title }}</h3>
                            <div class="card-tools">
                                @auth
                                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                                    <a href="{{ url('/drivers/create') }}" class="btn btn-primary btn-sm" title="Tambah Supir">
                                        Tambah Data Supir
                                    </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-bordered table-striped datatables">
                                        <thead>
                                            <th>Nama</th>
                                            <th>Nomer HP</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        // Setup Datatable
        var ajaxUrl  = "{{ url('drivers/dataTable') }}";
        var ajaxData = [];
        var columns  = [{ data: 'name' }, { data: 'phone_number' }, { data: 'status' }, { data: 'action' }];
        var columnDefs  =  [
            {
                targets: 2,
                data: 'name',
                name: 'name',
                render: function (data, type, row) {
                    return data.charAt(0).toUpperCase() + data.slice(1); // kapitalisasi
                }
            },
            {
                // Actions
                targets: -1,
                title: 'Actions',
                searchable: false,
                orderable: false,
                render: function(data, type, full, meta) {
                    return (
                        '<div class="d-flex align-items-center">' +
                            '<a href="{{ url("drivers/edit") }}'+'/'+full.id+'" class="btn btn-primary btn-sm edit-record mr-1" data-id="' + full.id + '"><i class="fa fa-edit"></i></a>'+
                        '</div>'
                    );
                }
            }
        ];
        var buttons =  [];
        // Setup Datatable

        $(document).ready(function() {
            initializeDataTable(ajaxUrl, ajaxData, columns, columnDefs, buttons);
        });
    </script>
@endsection

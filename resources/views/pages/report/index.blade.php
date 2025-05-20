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
                <div class="card card-default">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Rentang Tanggal</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" id="daterange" name="daterange" placeholder="Pilih rentang tanggal">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-secondary btn-sm" id="buttonReset">
                                    Reset
                                </button>
                                <button type="button" class="btn btn-primary text-light btn-sm" id="buttonSearch">
                                    Search
                                </button>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $card_title }}</h3>
                        <div class="card-tools">
                            <button id="btnExportExcel" class="btn btn-success btn-sm" type="submit"><i class="fas fa-file-excel"></i> Export Excel</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <table class="table table-bordered table-striped datatables">
                                    <thead>
                                        <th>Tanggal Pesanan</th>
                                        <th>Kendaraan</th>
                                        <th>Supir</th>
                                        <th>Tujuan</th>
                                        <th>Status Pesanan</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        // Setup Datatable
        var ajaxUrl  = "{{ url('report/dataTable') }}";
        var ajaxData = [];
        var columns  = [{ data: 'start_time' }, { data: 'vehicle.plate_number' }, { data: 'driver.name' }, { data: 'destination' }, { data: 'status' }];
        var columnDefs  =  [];
        var buttons =  [];
        // Setup Datatable

        $(document).ready(function() {
            //Date picker
            $('#daterange').daterangepicker({
                locale: {
                    format: 'MM/DD/YYYY'
                },
                opens: 'left' // Atau 'right', sesuaikan
            });

            initializeDataTable(ajaxUrl, ajaxData, columns, columnDefs, buttons);

            $('#buttonSearch').click(function(){
                ajaxData = {'date':$('#daterange').val()}
                initializeDataTable(ajaxUrl, ajaxData, columns, columnDefs, buttons);
            });

            $('#buttonReset').click(function(){
                $('#datetimepickerValue').val('')
            });

            $('#btnExportExcel').on('click', function () {
                let dateRange = $('#daterange').val();
                let url = '{{ url("report/download") }}';

                if (dateRange) {
                    url += '?date=' + encodeURIComponent(dateRange);
                }

                window.location.href = url;
            });
        });
    </script>
@endsection

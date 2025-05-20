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
                                    <label>Tanggal</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-sm datetimepicker-input" id="datetimepickerValue" placeholder="MM/DD/YYYY" data-target="#reservationdate">
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
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
                            <a href="{{ url('/patient/registration-patient') }}" class="btn btn-primary btn-sm" title="Tambah Pasien">
                                Tambah Data Pasien
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <table class="table table-bordered table-striped datatables">
                                    <thead>
                                        <th>No. RM</th>
                                        <th>Nama Pasien</th>
                                        <th>Tanggal Terakhir Periksa</th>
                                        <th>Opsi</th>
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
        var ajaxUrl  = "{{ url('report/history-patient/dataTable') }}";
        var ajaxData = [];
        var columns  = [{ data: 'patient.number_rekam_medis' }, { data: 'patient.name' }, { data: 'created_at' }, { data: 'action' }];
        var columnDefs  =  [
            {
                targets: 2, // Targetkan kolom 'created_at' (indeks ke-2 dalam array columns)
                render: function(data, type, full, meta) {
                    console.log('Original date:', data); // Debug: cek data asli
                    if (type === 'display' || type === 'filter') {
                        const date = new Date(data);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0'); // Bulan mulai dari 0
                        const year = String(date.getFullYear()).slice(-2); // Ambil 2 digit terakhir tahun
                        const hours = String(date.getHours()).padStart(2, '0');
                        const minutes = String(date.getMinutes()).padStart(2, '0');
                        const seconds = String(date.getSeconds()).padStart(2, '0');
                        return `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
                    }
                    return data; // Tetap kembalikan data asli untuk kebutuhan sorting atau export
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
                            '<a href="{{ url("patient-exams/show") }}'+'/'+full.id+'" class="btn btn-primary btn-sm edit-record mr-1" data-id="' + full.id + '"><i class="fa fa-edit"></i></a>'+
                        '</div>'
                    );
                }
            }
        ];
        var buttons =  [];
        // Setup Datatable

        $(document).ready(function() {
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });

            initializeDataTable(ajaxUrl, ajaxData, columns, columnDefs, buttons);

            $('#buttonSearch').click(function(){
                ajaxData = {'date':$('#datetimepickerValue').val()}
                initializeDataTable(ajaxUrl, ajaxData, columns, columnDefs, buttons);
            });

            $('#buttonReset').click(function(){
                $('#datetimepickerValue').val('')
            });
        });
    </script>
@endsection

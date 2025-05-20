@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- toast notification -->
        @if (session('error'))
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
        </div>
        @elseif (session('success'))
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
                            <div class="card-tools"></div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-bordered table-striped datatables">
                                        <thead>
                                            <th>Tanggal Berangkat</th>
                                            <th>Plat Nomor</th>
                                            <th>Supir</th>
                                            <th>Tujuan</th>
                                            <th>Status Dokumen</th>
                                            <th>Aksi</th>
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

        <!-- Modal Approve/Reject -->
        <div class="modal fade" id="modalApproval" tabindex="-1" role="dialog" aria-labelledby="modalApprovalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" id="formApproval">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalApprovalLabel">Konfirmasi Persetujuan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="modalApprovalMessage">
                            Apakah Anda yakin ingin menyetujui permintaan ini?
                        </div>
                        <input type="hidden" name="status" id="approvalStatus">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Ya, Lanjutkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        // Setup Datatable
        var ajaxUrl  = "{{ url('approvals/dataTable') }}";
        var ajaxData = [];
        var columns  = [{ data: 'start_time' }, { data: 'vehicle.plate_number' }, { data: 'driver.name' }, { data: 'destination' }, { data: 'status' }, { data: 'action' }];
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
                    if(full.status == 'pending'){}
                    return (
                        '<div class="d-flex align-items-center">' +
                            '<button class="btn btn-success btn-sm mr-1 btn-approve" data-id="' + full.id + '"><i class="fas fa-check-circle"></i></button>' +
                            '<button class="btn btn-danger btn-sm btn-reject" data-id="' + full.id + '"><i class="fas fa-times-circle"></i></button>' +
                        '</div>'
                    );
                }
            }
        ];
        var buttons =  [];
        // Setup Datatable

        $(document).ready(function() {
            initializeDataTable(ajaxUrl, ajaxData, columns, columnDefs, buttons);

            $(document).on('click', '.btn-approve, .btn-reject', function () {
                var id = $(this).data('id');
                var isApprove = $(this).hasClass('btn-approve');
                var actionUrl = '/approvals/' + id; // ganti sesuai route
                $('#formApproval').attr('action', actionUrl);
                $('#approvalStatus').val(isApprove ? 'approved' : 'rejected');
                $('#modalApprovalLabel').text(isApprove ? 'Konfirmasi Persetujuan' : 'Konfirmasi Penolakan');
                $('#modalApprovalMessage').text(
                    isApprove 
                    ? 'Apakah Anda yakin ingin MENYETUJUI permintaan ini?' 
                    : 'Apakah Anda yakin ingin MENOLAK permintaan ini?'
                );
                $('#modalApproval').modal('show');
            });
        });
    </script>
@endsection

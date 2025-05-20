@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        @if(session('error'))
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
        @endif

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
                            <li class="breadcrumb-item active"> {{ $title }} </li>
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
                    <div class="card-header">
                        <h3 class="card-title">{{ $card_title }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <form id="form" method="POST" action="{{ url('drivers/update').'/'.$data->id }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Supir</label>
                                        <input type="text" class="form-control" id="name" name="name"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomer SIM</label>
                                        <input type="text" class="form-control" id="license_number" name="license_number"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Masa Berakhir SIM</label>
                                        <input type="text" class="form-control datetimepicker-input" id="license_expiry_date" name="license_expiry_date"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomer Hp</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Ex : BMW"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Kontak Darurat</label>
                                        <input type="text" class="form-control" id="emergency_name" name="emergency_name"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hp Kontak Darurat</label>
                                        <input type="text" class="form-control" id="emergency_phone" name="emergency_phone"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="aktif">Aktif</option>
                                            <option value="nonaktif">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{ url('/vehincles') }}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="d-none" id="ok">Submit</button>
                            <button type="button" class="btn btn-primary" id="submit">Update</button>
                        </div>    
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- modal confirmation -->
        <div class="modal fade" id="modal-confirm">
            <div class="modal-dialog">
                <div class="modal-content" style="text-align:center">
                    <div class="modal-body">
                        <div class="info-icon">
                            <i class="fas fa-info"></i>
                        </div>
                        <h3 class="modal-title" id="modalTitle">Information</h3>
                        <p id="modalMessage">Are you sure you want to proceed with this action?</p>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="confirmModal" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal confirmation -->
          
    </div>
    <script>
        $(document).ready(function(){
            $('#submit').click(function(){
                $('#modal-confirm').modal('toggle');
            });
            $('#confirmModal').click(function(){
                $('#ok').click();
            });
        })
    </script>
@endsection

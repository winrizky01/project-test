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
                    <form id="form" method="POST" action="{{ url('bookings/store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Pemakaian</label>
                                        <div class="input-group date" id="booking_date" data-target-input="nearest">
                                            <input type="text" name="booking_date" class="form-control datetimepicker-input" data-target="#booking_date"/>
                                            <div class="input-group-append" data-target="#booking_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status" readonly>
                                            <option value="pending" selected>Pending</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pilih Kendaraan</label>
                                        <select name="vehicle_id" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach($vehicles as $vh)
                                                <option value="{{ $vh->id }}">{{ $vh->plate_number }} - {{ $vh->brand }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pilih Supir</label>
                                        <select name="driver_id" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach($drivers as $dv)
                                                <option value="{{ $dv->id }}">{{ $dv->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Lokasi Kendaraan</label>
                                        <textarea class="form-control" id="location" name="location"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tujuan Perjalanan</label>
                                        <textarea class="form-control" id="destination" name="destination"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" id="note" name="note"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="approval_lv_1">Disetujui oleh</label>
                                        <select name="approval_lv_1" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach($approvals_lv_1 as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="approval_level_2">Disetujui oleh (Level 2)</label>
                                        <select name="approval_level_2" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach($approvals_lv_2 as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{ url('/bookings') }}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="d-none" id="ok">Submit</button>
                            <button type="button" class="btn btn-primary" id="submit">Submit</button>
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
            $('#booking_date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm'
            });
            $('#submit').click(function(){
                $('#modal-confirm').modal('toggle');
            });
            $('#confirmModal').click(function(){
                $('#ok').click();
            });
        })
    </script>
@endsection

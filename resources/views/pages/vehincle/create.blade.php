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

        @if(session('success'))
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
                    <form id="form" method="POST" action="{{ url('vehincles/store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Plat Nomor</label>
                                        <input type="text" class="form-control" id="plate_number" name="plate_number" placeholder="Ex : L1234QS"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fungsi Kendaraan</label>
                                        <select class="form-control" name="type">
                                            <option value="">-- Pilih Fungsi --</option>
                                            <option value="angkutan_orang">Angkutan Orang</option>
                                            <option value="angkutan_barang">Angkutan Barang</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Merk Kendaraan</label>
                                        <input type="text" class="form-control" id="brand" name="brand" placeholder="Ex : BMW"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Model Kendaraan</label>
                                        <input type="text" class="form-control" id="model" name="model" placeholder="Ex : Sedan"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Aset Kendaraan</label>
                                        <select class="form-control" name="ownership">
                                            <option value="">-- Pilih Aset Kendaraan --</option>
                                            <option value="milik">Milik</option>
                                            <option value="sewa">Sewa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bahan Bakar</label>
                                        <select class="form-control" name="fuel_type">
                                            <option value="">-- Pilih Bahan Bakar --</option>
                                            <option value="bensin">Bensin</option>
                                            <option value="solar">Solar</option>
                                            <option value="listrik">Listrik</option>
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
            $('#submit').click(function(){
                $('#modal-confirm').modal('toggle');
            });
            $('#confirmModal').click(function(){
                $('#ok').click();
            });
        })
    </script>
@endsection

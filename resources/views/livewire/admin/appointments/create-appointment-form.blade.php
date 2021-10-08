<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Appointments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.appointments') }}">Appointments</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-12 -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <a href="{{ route('admin.appointments') }}" class="btn btn-primary btn-sm"><i
                                        class="fas fa-list"></i>
                                    &nbsp; Manage Appointment
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <form wire:submit.prevent="create">
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="client_id">Client:</label>
                                            <select class="form-control" wire:model.defer="state.client_id" id="client_id">
                                                <option value="" selected disabled>Select One</option>
                                                @foreach($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Date -->
                                        <div class="form-group">
                                            <label>Date:</label>
                                            <div wire:ignore class="input-group date" id="appointmentDate" data-target-input="nearest" data-appointmentdate="@this">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#appointmentDate" id="appointmentDateInput"/>
                                                <div class="input-group-append" data-target="#appointmentDate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Time -->
                                        <div class="form-group">
                                            <label>Date:</label>
                                            <div wire:ignore class="input-group date" id="appointmentTime" data-target-input="nearest" data-appointmenttime="@this">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#appointmentTime" id="appointmentTimeInput"/>
                                                <div class="input-group-append" data-target="#appointmentTime" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="note">Note:</label>
                                            <textarea class="form-control" wire:model.defer="state.note" id="note"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" class="btn btn-secondary"><i class="fas fa-times"></i> Cancel</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

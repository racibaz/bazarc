@extends('backend.master')

@section('breadcrumbs')
    User Breadcrumb
@stop

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Table With Full Features</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th>{{trans('user.form.name')}}</th>
                                    <th>{{trans('user.form.email')}}</th>
                                    <th>{{trans('user.form.cell_phone')}}</th>
                                    <th>{{trans('common.form.updated_at')}}</th>
                                    <th width="100px">{{trans('common.form.action')}}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </section>
@endsection

@push('css')
@endpush

@push('script')
    <script>
        $(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{!! route('users.anyData') !!}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'cell_phone', name: 'cell_phone' },
                    { data: 'updated_at', name: 'updated_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush

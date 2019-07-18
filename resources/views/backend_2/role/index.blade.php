@extends('backend.master')

@section('breadcrumbs')
    Role Breadcrumb
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
                                <th>{{trans('common.form.name')}}</th>
                                <th>{{trans('role.form.guard_name')}}</th>
                                <th>{{trans('common.form.updated_at')}}</th>
                                <th width="%10">{{trans('common.form.action')}}</th>
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

@push('scripts')
    <script>
        $(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{!! route('role.index') !!}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'guard_name', name: 'guard_name' },
                    { data: 'updated_at', name: 'updated_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush

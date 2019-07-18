@extends('backend.master')

@section('breadcrumbs')
    {{trans('activity_log.activity_logs')}}
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
                                <th>{{trans('activity_log.form.log_name')}}</th>
                                <th>{{trans('activity_log.form.description')}}</th>
                                <th>{{trans('activity_log.form.subject_id')}}</th>
                                <th>{{trans('activity_log.form.subject_type')}}</th>
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
                ajax: '{!! route('activity_log.index') !!}',
                columns: [
                    { data: 'log_name', name: 'log_name' },
                    { data: 'description', name: 'description' },
                    { data: 'subject_id', name: 'subject_id' },
                    { data: 'subject_type', name: 'subject_type' },
                    { data: 'updated_at', name: 'updated_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush

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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{trans('activity_log.form.log_name')}}</th>
                                    <th>{{trans('activity_log.form.description')}}</th>
                                    <th>{{trans('activity_log.form.subject_id')}}</th>
                                    <th>{{trans('activity_log.form.subject_type')}}</th>
                                    <th>{{trans('common.form.updated_at')}}</th>
                                    <th>{{trans('common.form.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <td>{{$record->log_name}}</td>
                                        <td>{{$record->description}}</td>
                                        <td>{{$record->subject_id}}</td>
                                        <td>{{$record->subject_type}}</td>
                                        <td>{{$record->updated_at}}</td>
                                        <td>
                                            <div class="margin">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">{{trans('common.form.action')}}</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item" href="{{route('activity_log.show', $record->id)}}">@lang('common.form.show')</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{trans('activity_log.form.log_name')}}</th>
                                <th>{{trans('activity_log.form.description')}}</th>
                                <th>{{trans('activity_log.form.subject_id')}}</th>
                                <th>{{trans('activity_log.form.subject_type')}}</th>
                                <th>{{trans('common.form.updated_at')}}</th>
                                <th>{{trans('common.form.action')}}</th>
                            </tr>
                            </tfoot>
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
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@endpush

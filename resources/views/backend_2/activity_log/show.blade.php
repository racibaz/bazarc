@extends('backend.master')

@section('breadcrumbs')
    User Breadcrumb Show
@stop

@section('content')

    <div class="col-md-6">

        <!-- Input addon -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">{{trans('activity_log.activity_logs')}}</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    {{ html()->label(trans('activity_log.form.log_name')) }}
                    {{$record->log_name}}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('activity_log.form.description')) }}
                    {{$record->description}}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('activity_log.form.subject_id')) }}
                    {{$record->subject_id}}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('activity_log.form.subject_type')) }}
                    {{$record->subject_type}}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('activity_log.form.causer_id')) }}
                    {{$record->causer_id}}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('activity_log.form.causer_type')) }}
                    {{$record->causer_type}}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('activity_log.form.properties')) }}
                    {{$record->properties}}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

@endsection

@push('css')
@endpush

@push('scripts')
@endpush

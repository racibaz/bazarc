@extends('backend.master')

@section('breadcrumbs')
    Role Breadcrumb Show
@stop

@section('content')

    <div class="col-md-6">

        <!-- Input addon -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Input Addon</h3>
            </div>

            <div class="card-body">
                <div class="form-group">
                    {{ html()->label(trans('common.form.name')) }}
                    {{$record->name}}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('role.form.guard_name')) }}
                    {{$record->email}}
                </div>
                <a class="btn btn-secondary" href="{{route('role.edit', $record->id)}}">@lang('common.form.edit')</a>
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

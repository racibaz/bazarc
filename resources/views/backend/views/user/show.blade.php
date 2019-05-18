@extends('backend.views.master')

@section('breadcrumbs')
    User Breadcrumb Show
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
                    {{ html()->label(trans('user.form.name')) }}
                    {{$record->name}}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('user.form.email')) }}
                    {{$record->email}}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('user.form.cell_phone')) }}
                    {{$record->cell_phone}}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('user.form.web_site')) }}
                    {{$record->web_site}}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('user.form.bio_note')) }}
                    {{$record->bio_note}}
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

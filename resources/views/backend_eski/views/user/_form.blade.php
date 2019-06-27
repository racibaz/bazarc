@extends('backend.views.master')

@section('breadcrumbs')
    @if(isset($record->id))
        User Breadcrumb Edit
    @else
        User Breadcrumb Create
    @endif
@stop

@section('content')

    <div class="col-md-6">

        <!-- Input addon -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Input Addon</h3>
            </div>

            @if(isset($record->id))
                {{ html()->modelForm($record, 'PATCH', route('user.update', $record))->class('form-horizontal')->open() }}
            @else
                {{ html()->modelForm($record, 'POST', route('user.store'))->class('form-horizontal')->open() }}
            @endif
                <div class="card-body">
                    <div class="form-group">
                        {{ html()->label(trans('user.form.name')) }}
                        {{ html()->text('name')->class('form-control') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans('user.form.email')) }}
                        {{ html()->email('email')->class('form-control') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans('user.form.password')) }}
                        {{ html()->password('password')->value('')->class('form-control') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans('user.form.cell_phone')) }}
                        {{ html()->text('cell_phone')->class('form-control') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans('user.form.web_site')) }}
                        {{ html()->text('web_site')->class('form-control') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans('user.form.bio_note')) }}
                        {{ html()->textarea('bio_note')->class('form-control') }}
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-info"> @lang('common.form.save') </button>
                    {{--@if($record->id)--}}
                        {{--{{ html()->form('DELETE')->action(route('user.destroy', $record->id))->open() }}--}}
                            {{--{{html()->button(trans('common.form.delete'),'submit')->class('btn btn-danger') }}--}}
                        {{--{{ html()->closeModelForm() }}--}}
                    {{--@endif--}}
                    <button type="submit" onclick="window.history.go(-1); return false;" class="btn btn-default float-right">@lang('common.form.cancel')</button>
                </div>
            {{ html()->closeModelForm() }}
        </div>
        <!-- /.card -->
    </div>

@endsection

@push('css')
@endpush

@push('scripts')

@endpush

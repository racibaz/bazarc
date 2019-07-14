@extends('backend.master')

@section('breadcrumbs')
    @if(isset($record->id))
        Role Breadcrumb Edit
    @else
        Role Breadcrumb Create
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
                {{ html()->modelForm($record, 'PATCH', route('role.update', $record))->class('form-horizontal')->open() }}
            @else
                {{ html()->modelForm($record, 'POST', route('role.store'))->class('form-horizontal')->open() }}
            @endif
                <div class="card-body">
                    <div class="form-group">
                        {{ html()->label(trans('common.form.name')) }}
                        {{ html()->text('name')->class('form-control') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans('role.form.guard_name')) }}
                        {{ html()->text('guard_name')->class('form-control') }}
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-info"> @lang('common.form.save') </button>
{{--                    @if($record->id)--}}
{{--                        {{ html()->form('DELETE')->action(route('role.destroy', $record->id))->open() }}--}}
{{--                            {{html()->button(trans('common.form.delete'),'submit')->class('btn btn-danger') }}--}}
{{--                        {{ html()->closeModelForm() }}--}}
{{--                    @endif--}}
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

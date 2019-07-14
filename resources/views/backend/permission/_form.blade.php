@extends('backend.master')

@section('breadcrumbs')
    @if(isset($record->id))
        Permission Breadcrumb Edit
    @else
        Permission Breadcrumb Create
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
                {{ html()->modelForm($record, 'PATCH', route('permission.update', $record))->class('form-horizontal')->open() }}
            @else
                {{ html()->modelForm($record, 'POST', route('permission.store'))->class('form-horizontal')->open() }}
            @endif
                <div class="card-body">
                    <div class="form-group">
                        {{ html()->label(trans('common.form.name')) }}
                        {{ html()->text('name')->class('form-control') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label(trans('permission.form.guard_name')) }}
                        {{ html()->text('guard_name')->class('form-control') }}
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-info"> @lang('common.form.save') </button>
{{--                    @if($record->id)--}}
{{--                        {{ html()->form('DELETE')->action(route('permission.destroy', $record->id))->open() }}--}}
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

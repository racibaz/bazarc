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

            {{--@if(isset($record->id))--}}
                {{--{{ html()->modelForm($record, 'PATCH', route('setting.update', $record))->class('form-horizontal')->open() }}--}}
            {{--@else--}}
                {{ html()->modelForm([], 'POST', route('setting.store'))->class('form-horizontal')->open() }}
            {{--@endif--}}
            <div class="card-body">
                <div class="form-group">
                    {{ html()->label(trans('setting.form.title')) }}
                    {{ html()->text('title')->value($title)->class('form-control') }}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('setting.form.slogan')) }}
                    {{ html()->text('slogan')->value($slogan)->class('form-control') }}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('setting.form.description')) }}
                    {{ html()->textarea('description')->value($description)->class('form-control') }}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('setting.form.keywords')) }}
                    {{ html()->text('keywords')->value($keywords)->class('form-control') }}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('setting.form.url')) }}
                    {{ html()->text('url')->value($url)->class('form-control') }}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('setting.form.timezone')) }}
                    {{ html()->select('timezone', $timezoneList, $defaultTimezone)->class('form-control') }}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('setting.form.registration_type')) }}
                    {{ html()->select('registration_type', $registrationTypes, $registrationType)->class('form-control') }}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('setting.form.user_default_role')) }}
                    {{ html()->select('user_default_role', $roles, $userDefaultRole)->class('form-control') }}
                </div>
                <div class="form-group">
                    {{ html()->label(trans('setting.form.user_default_status')) }}
                    {{ html()->select('user_default_status', $statuses, $userDefaultStatus)->class('form-control') }}
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

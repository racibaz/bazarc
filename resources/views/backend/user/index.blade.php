@extends('backend.master')

@section('breadcrumbs')
    User Breadcrumb
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
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                        </table>

{{--                        <table id="table" class="table table-bordered table-striped">--}}
{{--                            <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>{{trans('user.form.name')}}</th>--}}
{{--                                    <th>{{trans('user.form.email')}}</th>--}}
{{--                                    <th>{{trans('user.form.cell_phone')}}</th>--}}
{{--                                    <th>{{trans('common.form.updated_at')}}</th>--}}
{{--                                    <th>{{trans('common.form.action')}}</th>--}}
{{--                                </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                                @foreach($users as $user)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$user->name}}</td>--}}
{{--                                        <td>{{$user->email}}</td>--}}
{{--                                        <td>{{$user->cell_phone}}</td>--}}
{{--                                        <td>{{$user->updated_at}}</td>--}}
{{--                                        <td>--}}
{{--                                            <div class="margin">--}}
{{--                                                <div class="btn-group">--}}
{{--                                                    <button type="button" class="btn btn-info">{{trans('common.form.action')}}</button>--}}
{{--                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">--}}
{{--                                                        <span class="caret"></span>--}}
{{--                                                        <span class="sr-only">Toggle Dropdown</span>--}}
{{--                                                    </button>--}}
{{--                                                    <div class="dropdown-menu" role="menu">--}}
{{--                                                        <a class="dropdown-item" href="{{route('user.edit', $user->id)}}">@lang('common.form.edit')</a>--}}
{{--                                                        <a class="dropdown-item" href="{{route('user.show', $user->id)}}">@lang('common.form.show')</a>--}}
{{--                                                        {{ html()->form('DELETE')->action(route('user.destroy', $user->id))->open() }}--}}
{{--                                                                {{html()->button(trans('common.form.delete'),'submit')->class('dropdown-item') }}--}}
{{--                                                        {{ html()->closeModelForm() }}--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                            </tbody>--}}
{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <th>{{trans('user.form.name')}}</th>--}}
{{--                                <th>{{trans('user.form.email')}}</th>--}}
{{--                                <th>{{trans('user.form.cell_phone')}}</th>--}}
{{--                                <th>{{trans('common.form.updated_at')}}</th>--}}
{{--                                <th>{{trans('common.form.action')}}</th>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
{{--                        </table>--}}
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
                ajax: '{!! route('users.anyData') !!}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' }
                ]
            });
        });
    </script>
@endpush

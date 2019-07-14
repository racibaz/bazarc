@extends('backend.master')

@section('breadcrumbs')
    Role Breadcrumb
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
                                    <th>{{trans('common.form.name')}}</th>
                                    <th>{{trans('role.form.guard_name')}}</th>
                                    <th>{{trans('common.form.updated_at')}}</th>
                                    <th>{{trans('common.form.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->guard_name}}</td>
                                        <td>{{$role->updated_at}}</td>
                                        <td>
                                            <div class="margin">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">{{trans('common.form.action')}}</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item" href="{{route('role.edit', $role->id)}}">@lang('common.form.edit')</a>
                                                        <a class="dropdown-item" href="{{route('role.show', $role->id)}}">@lang('common.form.show')</a>
                                                        {{ html()->form('DELETE')->action(route('role.destroy', $role->id))->open() }}
                                                                {{html()->button(trans('common.form.delete'),'submit')->class('dropdown-item') }}
                                                        {{ html()->closeModelForm() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{trans('common.form.name')}}</th>
                                <th>{{trans('role.form.guard_name')}}</th>
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

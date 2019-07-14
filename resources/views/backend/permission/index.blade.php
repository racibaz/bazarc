@extends('backend.master')

@section('breadcrumbs')
    Permission Breadcrumb
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
                                    <th>{{trans('permission.form.guard_name')}}</th>
                                    <th>{{trans('common.form.updated_at')}}</th>
                                    <th>{{trans('common.form.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->guard_name}}</td>
                                        <td>{{$permission->updated_at}}</td>
                                        <td>
                                            <div class="margin">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">{{trans('common.form.action')}}</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" permission="menu">
                                                        <a class="dropdown-item" href="{{route('permission.edit', $permission->id)}}">@lang('common.form.edit')</a>
                                                        <a class="dropdown-item" href="{{route('permission.show', $permission->id)}}">@lang('common.form.show')</a>
                                                        {{ html()->form('DELETE')->action(route('permission.destroy', $permission->id))->open() }}
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
                                <th>{{trans('permission.form.guard_name')}}</th>
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

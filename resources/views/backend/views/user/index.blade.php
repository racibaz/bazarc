@extends('backend.views.master')

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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{trans('user.form.name')}}</th>
                                    <th>{{trans('user.form.email')}}</th>
                                    <th>{{trans('user.form.cell_phone')}}</th>
                                    <th>{{trans('common.form.updated_at')}}</th>
                                    <th>{{trans('common.form.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->cell_phone}}</td>
                                        <td>{{$user->updated_at}}</td>
                                        <td>
                                            <div class="margin">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">{{trans('common.form.action')}}</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item" href="{{route('user.edit',$user->id)}}">{{trans('common.form.edit')}}</a>
                                                        <a class="dropdown-item" href="{{route('user.show',$user->id)}}">{{trans('common.form.show')}}</a>
                                                        {{html()->form()->method('Delete')->action(route('user.destroy',$user->id))}}
                                                            <a class="dropdown-item" href="{{route('user.destroy',$user->id)}}">{{trans('common.form.destroy')}}</a>
                                                        {{html()->closeModelForm()}}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{trans('user.form.name')}}</th>
                                <th>{{trans('user.form.email')}}</th>
                                <th>{{trans('user.form.cell_phone')}}</th>
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

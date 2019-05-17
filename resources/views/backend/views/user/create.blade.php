@extends('backend.views.master')

@section('breadcrumbs')
    User Breadcrumb Edit
@stop

@section('content')

    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

        <!-- Form Element sizes -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Different Height</h3>
            </div>
            <div class="card-body">
                <input class="form-control form-control-lg" type="text" placeholder=".input-lg">
                <br>
                <input class="form-control" type="text" placeholder="Default input">
                <br>
                <input class="form-control form-control-sm" type="text" placeholder=".input-sm">
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Different Width</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder=".col-3">
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" placeholder=".col-4">
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control" placeholder=".col-5">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- Input addon -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Input Addon</h3>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Username">
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>

                <h4>With icons</h4>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control" placeholder="Email">
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-check"></i></span>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-dollar"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fa fa-ambulance"></i></div>
                    </div>
                </div>

                <h5 class="mt-4 mb-2">With checkbox and radio inputs</h5>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox">
                        </span>
                            </div>
                            <input type="text" class="form-control">
                        </div>
                        <!-- /input-group -->
                    </div>
                    <!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><input type="radio"></span>
                            </div>
                            <input type="text" class="form-control">
                        </div>
                        <!-- /input-group -->
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->

                <h5 class="mt-4 mb-2">With buttons</h5>

                <p>Large: <code>.input-group.input-group-lg</code></p>

                <div class="input-group input-group-lg mb-3">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item"><a href="#">Action</a></li>
                            <li class="dropdown-item"><a href="#">Another action</a></li>
                            <li class="dropdown-item"><a href="#">Something else here</a></li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    <!-- /btn-group -->
                    <input type="text" class="form-control">
                </div>
                <!-- /input-group -->

                <p>Normal</p>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger">Action</button>
                    </div>
                    <!-- /btn-group -->
                    <input type="text" class="form-control">
                </div>
                <!-- /input-group -->

                <p>Small <code>.input-group.input-group-sm</code></p>
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control">
                    <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat">Go!</button>
                  </span>
                </div>
                <!-- /input-group -->
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

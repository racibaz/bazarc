
@extends('backend.views.master')

@section('breadcrumbs')
    User Breadcrumb
@stop

@section('content')
    @foreach ($users as $user)
        {{ $user->name }}
        <br />
    @endforeach
@endsection
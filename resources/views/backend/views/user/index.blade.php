

@extends('backend.views.master')

@section('content')
    @foreach ($users as $user)
        {{ $user->name }}
        <br />
    @endforeach
@endsection
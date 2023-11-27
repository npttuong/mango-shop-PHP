@extends('admin.layout-admin')

@section('content')
  @include('partials.profile', ['user' => $user])
@endsection

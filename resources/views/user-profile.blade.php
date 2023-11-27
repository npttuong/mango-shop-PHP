@extends('layout')

@section('content')
  @include('partials.profile', ['user' => $user])
@endsection

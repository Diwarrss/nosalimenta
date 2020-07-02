@extends('layouts.app')

@section('content')
<div>
  @auth
    <home-client></home-client>
  @endauth
</div>
@endsection

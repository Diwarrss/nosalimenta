@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    @auth
      @if (Auth::user()->rol_id == 1)
        <home-admin></home-admin>
      @else
        <home-client></home-client>
      @endif
    @endauth
  </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<h1 class="text-center">Learn pro acadmy</h1>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <a class="navbar-brand text-right" href="{{ route('register.form') }}">Register</a>
        <a class="navbar-brand text-right" href="{{ route('login.form') }}">Login</a>
        {{-- <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> --}}
      </div>
    </div>
  </nav>
    {{-- <img src="{{ asset('img/img1.jpg') }}" class="img-fluid" alt="description of myimage"> --}}
{{-- <img src="{{ asset('/public/upload/image.jpg') }}"> <div></div>--}}
@endsection

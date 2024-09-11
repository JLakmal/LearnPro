    <title>Login</title>

@extends('layouts.app')
@section('content')

    <div class="container-xl">
        <h1 class="text-center p-5">Login form</h1>
    <form class="row g-2" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-2 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="email" name="email" class="form-control" id="staticEmail" value="">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="inputPassword">
            </div>
        </div>
    <button type="submit" class="btn btn-success position-relative">Login</button>
    </form>


@endsection

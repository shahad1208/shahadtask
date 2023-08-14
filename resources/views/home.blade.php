@extends('layouts.app')

@section('content')


<a href="home/view-profile" class="btn btn-link">View Profile</a>

<a href="home/show-all-users" class="btn btn-primary">Show ALl Users</a>

<a href="home/users/sendemailto" class="btn btn-link">Send Email To User</a>

<h1>Home :: {{ Auth::user()->name }}</h1>


@endsection
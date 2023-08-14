@extends('admin.layout.app')
@section('content')

@if (auth()->user()->isAdmin())
    <h1>Welcome Admin {{ auth()->user()->name }}</h1>
    <!-- Display admin-specific content -->
@else
    <h1>Welcome {{ auth()->user()->name }}</h1>
    <!-- Display user-specific content -->
@endif

@endsection


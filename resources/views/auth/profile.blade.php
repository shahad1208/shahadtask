@extends('layouts.app')
@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="card">
  <img src="{{ asset('uploads/' . Auth::user()->image) }}" alt="John" style="width:100%">
  <h4>User Name :-> {{Auth::user()->name}}</h4>
  
  <h4>Mobile No - {{Auth::user()->email}}</h4>
  <h4>Mobile No - {{Auth::user()->phone}}</h4>

  <a href="#"><i class="fa fa-dribbble"></i></a>
  <a href="#"><i class="fa fa-twitter"></i></a>
  <a href="#"><i class="fa fa-linkedin"></i></a>
  <a href="#"><i class="fa fa-facebook"></i></a>
  <p><a href="{{url('home/view-profile/' . Auth::user()->id.'/edit')}}" class="btn btn-danger">Edit Profile</a></p>
</div>


@endsection
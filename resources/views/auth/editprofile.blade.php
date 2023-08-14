@extends('layouts.app')
@section('content')


<div class="container">
	<div class="row">
		<div class="card-body">
			
			<h1 class="text-center">Edit Profile</h1>

<form action="{{ url('home/view-profile/' . $user->id . '/edit') }}" method="post" enctype="multipart/form-data">
	@csrf
	@method('PUT')
				<div class="form-group">
    <label for="email">Name:</label>
    <input type="text" class="form-control"  id="email" name="name" value="{{$user->name}}">
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control"  id="email" name="email" value="{{$user->email}}">
  </div>
  <div class="form-group">
    <label for="email">Mobile No:</label>
    <input type="tel" class="form-control"  id="email" name="phone" value="{{$user->phone}}">
  </div>


<div class="form-group">
        <label for="image">Profile Image</label>
        <input type="file" class="form-control" id="image" name="image" value="{{ $user->image }}">
        <img src="{{ asset('uploads/'.$user->image) }}" alt="Profile Image" style="max-width: 100px;">
    </div>

  
  
  <button type="submit" class="btn btn-primary">Update</button>
</form>
		</div>

	</div>
</div>	


@endsection
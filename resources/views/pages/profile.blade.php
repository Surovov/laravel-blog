@extends('layout')

@section('content')

<div class="leave-comment mr0"><!--leave comment-->
    <h3 class="text-uppercase">My profile</h3>
    <br>

    <img src="{{$user->getAvatar()}}" alt="" class="profile-image">
    <form class="form-horizontal contact-form" role="form" method="post" action="/profile" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="col-md-12">
                <input type="text" class="form-control" id="name" name="name"
                       placeholder="Name" value="{{$user->name}}" >
            </div>
        </div>
        <!-- profile.blade.php -->
        <div class="uk-margin">
            <label for="description" class="uk-form-label">Description</label>
            <p>{{ $user->description }}</p>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <input type="email" class="form-control" id="email" name="email"
                       placeholder="Email" value="{{$user->email}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="password">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
				<input type="file" class="form-control" id="image" name="avatar">	
            </div>
        </div>
        <button type="submit"  class="btn send-btn">Update</button>

    </form>
</div><!--end leave comment-->

@endsection

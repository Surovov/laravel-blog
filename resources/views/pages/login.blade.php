@extends('layout')

@section('content')

<div class="leave-comment mr0"><!--leave comment-->
    @if(session('status'))
        {{session('status')}}
    @endif  
    <h3 class="text-uppercase">Login</h3>
    <br>
    <form class="form-horizontal contact-form" role="form" method="post" action="/login">
        {{csrf_field()}}
        <div class="form-group">
            <div class="col-md-12">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
            </div>
        </div>
        <button type="submit" name="submit" class="btn send-btn">Login</button>
    </form>
</div><!--end leave comment-->

@endsection

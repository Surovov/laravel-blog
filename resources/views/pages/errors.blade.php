@if($errors->any())
<div class="alert alert-danger" uk-alert>
    <ul class="">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session('status'))
    <div class="alert alert-info">{{session('status')}}</div>
@endif
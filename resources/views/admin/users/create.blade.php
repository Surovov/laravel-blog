@extends('admin.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Добавить пользователя
    <small>приятные слова..</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    {!! html()
        ->form()
        ->route('users.store')
        ->attribute('enctype', 'multipart/form-data')
        ->open() !!}
    <div class="box-header with-border">
      <h3 class="box-title">Добавляем пользователя</h3>
        @include('admin.errors')

    </div>
    <div class="box-body">
      <div class="col-md-6">
        <div class="form-group">
            {!! html()->label('Имя', 'name') !!}
            {!! html()->text('name')->attribute('class', 'form-control') !!}
        </div>
        <div class="form-group">
            {!! html()->label('E-mail', 'email') !!}
            {!! html()->email('email')->attribute('class', 'form-control') !!}
         </div>
        <div class="form-group">
            {!! html()->label('Пароль', 'password') !!}
            {!! html()->password('password')->attribute('class', 'form-control') !!}
        </div>
        <div class="form-group">
          {!! html()->label('Аватар', 'avatar') !!}
          {!! html()->file('avatar')->attribute('class', 'form-control') !!}
          <p class="help-block">Какое-нибудь уведомление о форматах..</p>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <a href="{{route('users.index')}}" class="btn btn-default">Назад</a>
        {!! html()->submit('Добавить')->attribute('class', 'btn btn-success pull-right') !!}
    </div>
    <!-- /.box-footer-->
    {!! html()->form()->close() !!}

  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@extends('admin.layout')

@section('content')
<div class="uk-margin">
  {!! html()
      ->form()
      ->route('subscriptions.store')
      ->attribute('enctype', 'multipart/form-data')
      ->open() !!}
  
  <h3 class="uk-heading-bullet">Добавляем подписечника</h3>

  <div class="uk-margin">
    {!! html()->label('Почта', 'email')->attribute('class', 'uk-form-label') !!}
    {!! html()->text('email')->attribute('class', 'uk-input')->value(old('email')) !!}
  </div>

  <div class="uk-margin">
    <a href="{{ route('subscriptions.index') }}" class="uk-button uk-button-default">Назад</a>
    {!! html()->submit('Добавить')->attribute('class', 'uk-button uk-button-primary uk-align-right') !!}
  </div>
  
  {!! html()->form()->close() !!}
</div>
@endsection

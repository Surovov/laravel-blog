@extends('admin.layout')

@section('content')
<div class="uk-margin">
  {!! html()
      ->form()
      ->route('categories.store')
      ->attribute('enctype', 'multipart/form-data')
      ->open() !!}
  
  <h3 class="uk-heading-bullet">Добавляем категорию</h3>

  <div class="uk-margin">
    {!! html()->label('Название Категории', 'title')->attribute('class', 'uk-form-label') !!}
    {!! html()->text('title')->attribute('class', 'uk-input') !!}
  </div>

  <div class="uk-margin">
    <a href="{{ route('categories.index') }}" class="uk-button uk-button-default">Назад</a>
    {!! html()->submit('Добавить')->attribute('class', 'uk-button uk-button-primary uk-align-right') !!}
  </div>
  
  {!! html()->form()->close() !!}
</div>
@endsection

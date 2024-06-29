@extends('admin.layout')

@section('content')
{!! html()
    ->form()
    ->route('tags.store')
    ->attribute('enctype', 'multipart/form-data')
    ->open() !!}

<h3 class="uk-heading-bullet">Добавляем ТЕГ</h3>

<div class="uk-margin">
    {!! html()->label('Название TAG', 'title')->attribute('class', 'uk-form-label') !!}
    {!! html()->text('title')->attribute('class', 'uk-input') !!}
</div>

<div class="uk-margin uk-text-right">
    <a href="{{ route('tags.index') }}" class="uk-button uk-button-default">Назад</a>
    {!! html()->submit('Добавить')->attribute('class', 'uk-button uk-button-primary') !!}
</div>

{!! html()->form()->close() !!}
@endsection

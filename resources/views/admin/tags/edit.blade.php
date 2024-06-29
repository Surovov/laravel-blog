@extends('admin.layout')

@section('content')
{!! html()
    ->form()
    ->route('tags.update', ['tag' => $tag->id])
    ->attribute('enctype', 'multipart/form-data')
    ->open() !!}
@method('PUT')

<h3 class="uk-heading-bullet">Редактируем TAG</h3>

<div class="uk-margin">
    {!! html()->label('Название TAG', 'title')->attribute('class', 'uk-form-label') !!}
    {!! html()->text('title', $tag->title)->attribute('class', 'uk-input') !!}
</div>

<div class="uk-margin uk-text-right">
    <a href="{{ route('tags.index') }}" class="uk-button uk-button-default">Назад</a>
    {!! html()->submit('Сохранить')->attribute('class', 'uk-button uk-button-primary') !!}
</div>

{!! html()->form()->close() !!}
@endsection

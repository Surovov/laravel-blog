@extends('admin.layout')

@section('content')
{!! html()
    ->form()
    ->route('categories.update', ['category' => $category->id])
    ->attribute('enctype', 'multipart/form-data')
    ->open() !!}
@method('PUT')

<h3 class="uk-heading-bullet">Редактируем категорию</h3>

@if($errors->any())
    <div class="uk-alert-danger" uk-alert>
        <ul class="uk-list uk-list-bullet">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="uk-margin">
    {!! html()->label('Название Категории', 'title')->attribute('class', 'uk-form-label') !!}
    {!! html()->text('title', $category->title)->attribute('class', 'uk-input') !!}
</div>

<div class="uk-margin uk-text-right">
    <a href="{{ route('categories.index') }}" class="uk-button uk-button-default">Назад</a>
    {!! html()->submit('Сохранить')->attribute('class', 'uk-button uk-button-primary') !!}
</div>

{!! html()->form()->close() !!}
@endsection

@extends('admin.layout')

@section('content')
{!! html()
    ->form()
    ->route('posts.store')
    ->attribute('enctype', 'multipart/form-data')
    ->open() !!}
  
<h3 class="uk-heading-bullet">Добавляем статью</h3>

<div class="uk-margin">
    {!! html()->label('Название', 'title')->attribute('class', 'uk-form-label') !!}
    {!! html()->text('title')->attribute('class', 'uk-input')->value(old('title')) !!}
</div>


<div class="uk-margin" uk-margin>
    {!! html()->label('Аватар', 'image')->attribute('class', 'uk-form-label') !!}
    <div uk-form-custom="target: true">
        <input type="file" name="image" aria-label="Custom controls">
        <input class="uk-input uk-form-width-medium" type="text" placeholder="Выберите файл" aria-label="Custom controls" disabled>
    </div>
</div>


<div class="uk-margin">
    {!! html()->label('Категория', 'category_id')->attribute('class', 'uk-form-label') !!}
    {!! html()->select('category_id', $categories)
        ->class('uk-select')
        ->placeholder('Выберите категорию')
        ->value(old('category_id')) !!}
</div>

<div class="uk-margin">
    {!! html()->label('Теги', 'tags')->attribute('class', 'uk-form-label') !!}
    {!! html()->select('tags[]', $tags)
        ->class('uk-select')
        ->multiple()
        ->attribute('data-placeholder', 'Выберите теги')
        ->value(old('tags')) !!}
</div>

<div class="uk-margin">
    {!! html()->label('Дата', 'date')->attribute('class', 'uk-form-label') !!}
    {!! html()->text('date', old('date'))
        ->attribute('class', 'uk-input')
        ->id('date')
        ->attribute('type', "date") !!}
</div>

<div class="uk-margin">
    <label>
        {!! html()->checkbox('is_featured', '1', old('is_featured'))->class('uk-checkbox') !!}
        Рекомендовать
    </label>
</div>

<div class="uk-margin">
    <label>
        {!! html()->checkbox('status', '1', old('status'))->class('uk-checkbox') !!}
        Черновик
    </label>
</div>


<div class="uk-margin">
    {!! html()->label('Полный текст', 'content')->attribute('class', 'uk-form-label') !!}
    {!! html()->textarea('content')->class('uk-textarea trix-content')->rows(10)->value(old('content')) !!}
</div>

<div class="uk-margin uk-text-right">
    <a href="{{ route('posts.index') }}" class="uk-button uk-button-default">Назад</a>
    {!! html()->submit('Добавить')->attribute('class', 'uk-button uk-button-primary') !!}
</div>
{!! html()->form()->close() !!}
@endsection

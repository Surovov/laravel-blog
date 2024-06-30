@extends('admin.layout')

@section('content')
{!! html()
    ->form()
    ->route('posts.update', $post->id)
    ->attribute('enctype', 'multipart/form-data')
    ->open() !!}
@method('PUT')

<h3 class="uk-heading-bullet">Редактирование статьи</h3>

<div class="uk-margin">
    {!! html()->label('Название', 'title')->attribute('class', 'uk-form-label') !!}
    {!! html()->text('title', $post->title)->attribute('class', 'uk-input')->placeholder('Введите название статьи') !!}
</div>



<div class="uk-margin" uk-margin>
    <img src="{{$post->getImage()}}" width="200px;"><br>
    {!! html()->label('Картинка', 'image')->attribute('class', 'uk-form-label') !!}
    <div uk-form-custom="target: true">
        <input type="file" name="image" aria-label="Custom controls">
        <input class="uk-input uk-form-width-medium" type="text" placeholder="Выберите файл" aria-label="Custom controls" disabled>
    </div>
</div>



<div class="uk-margin">
    {!! html()->label('Категория', 'category_id')->attribute('class', 'uk-form-label') !!}
    {!! html()->select('category_id', $categories, $post->category_id)
        ->class('uk-select')
        ->placeholder('Выберите категорию') !!}
</div>

<div class="uk-margin">
    {!! html()->label('Теги', 'tags')->attribute('class', 'uk-form-label') !!}
    {!! html()->select('tags[]', $tags, $post->tags->pluck('id')->toArray())
        ->multiple()
        ->class('uk-select')
        ->attribute('data-placeholder', 'Выберите теги') !!}
</div>

<div class="uk-margin">
    {!! html()->label('Дата', 'date')->attribute('class', 'uk-form-label') !!}
    {!! html()->text('date', $post->date)
        ->attribute('class', 'uk-input')
        ->attribute('type', 'date') !!}
</div>

<div class="uk-margin">
    <label>
        {!! html()->checkbox('is_featured', $post->is_featured)->class('uk-checkbox') !!}
        Рекомендовать
    </label>
</div>

<div class="uk-margin">
    <label>
        {!! html()->checkbox('status', $post->status)->class('uk-checkbox') !!}
        Черновик
    </label>
</div>

<div class="uk-margin">
    {!! html()->label('Полный текст', 'content')->attribute('class', 'uk-form-label') !!}
    {!! html()->textarea('content', $post->content)->class('uk-textarea trix-content')->rows(10) !!}
</div>

<div class="uk-margin uk-text-right">
    <a href="{{ route('posts.index') }}" class="uk-button uk-button-default">Назад</a>
    {!! html()->submit('Сохранить')->attribute('class', 'uk-button uk-button-primary') !!}
</div>


{!! html()->form()->close() !!}


@endsection

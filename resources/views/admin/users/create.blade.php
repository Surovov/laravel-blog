@extends('admin.layout')

@section('content')
{!! html()
    ->form()
    ->route('users.store')
    ->attribute('enctype', 'multipart/form-data')
    ->open() !!}

<h3 class="uk-heading-bullet">Добавляем пользователя</h3>

<div class="uk-margin">
    {!! html()->label('Имя', 'name')->attribute('class', 'uk-form-label') !!}
    {!! html()->text('name')->attribute('class', 'uk-input') !!}
</div>

<div class="uk-margin">
    {!! html()->label('E-mail', 'email')->attribute('class', 'uk-form-label') !!}
    {!! html()->email('email')->attribute('class', 'uk-input') !!}
</div>

<div class="uk-margin">
    {!! html()->label('Пароль', 'password')->attribute('class', 'uk-form-label') !!}
    {!! html()->password('password')->attribute('class', 'uk-input') !!}
</div>

<div class="uk-margin" uk-margin>
    {!! html()->label('Аватар', 'avatar')->attribute('class', 'uk-form-label') !!}
    <div uk-form-custom="target: true">
        <input type="file" name="avatar" aria-label="Custom controls">
        <input class="uk-input uk-form-width-medium" type="text" placeholder="Выберите файл" aria-label="Custom controls" disabled>
    </div>
</div>

<div class="uk-margin uk-text-right">
    <a href="{{ route('users.index') }}" class="uk-button uk-button-default">Назад</a>
    {!! html()->submit('Добавить')->attribute('class', 'uk-button uk-button-primary') !!}
</div>

{!! html()->form()->close() !!}
@endsection

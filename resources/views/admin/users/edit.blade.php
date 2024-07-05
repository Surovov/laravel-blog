@extends('admin.layout')

@section('content')
{!! html()
    ->form()
    ->route('users.update', ['user' => $user->id])
    ->attribute('enctype', 'multipart/form-data')
    ->open() !!}
@method('PUT')

<h3 class="uk-heading-bullet">Редактируем пользователя</h3>

<div class="uk-margin">
    {!! html()->label('Имя', 'name')->attribute('class', 'uk-form-label') !!}
    {!! html()->text('name', $user->name)->attribute('class', 'uk-input') !!}
</div>
<div class="uk-margin">
    <label for="description" class="uk-form-label">Description</label>
    <textarea name="description" class="uk-textarea">{{ old('description', $user->description ?? '') }}</textarea>
</div>

<div class="uk-margin">
    {!! html()->label('E-mail', 'email')->attribute('class', 'uk-form-label') !!}
    {!! html()->email('email', $user->email)->attribute('class', 'uk-input') !!}
</div>

<div class="uk-margin">
    {!! html()->label('Пароль', 'password')->attribute('class', 'uk-form-label') !!}
    {!! html()->password('password')->attribute('class', 'uk-input') !!}
</div>

<div class="uk-margin">
    {!! html()->label('Актуальный аватар', 'current_avatar')->attribute('class', 'uk-form-label') !!}
    <div>
        <img src="{{ $user->getAvatar() }}" alt="Current Avatar" class="uk-border-circle" width="100">
    </div>
</div>
<div class="uk-margin" uk-margin>
    <img src="{{$user->getAvatar()}}" width="200px;"><br>
    {!! html()->label('Аватар', 'avatar')->attribute('class', 'uk-form-label') !!}
    <div uk-form-custom="target: true">
        <input type="file" name="avatar" aria-label="Custom controls">
        <input class="uk-input uk-form-width-medium" type="text" placeholder="Выберите файл" aria-label="Custom controls" disabled>
    </div>
</div>

<div class="uk-margin uk-text-right">
    <a href="{{ route('users.index') }}" class="uk-button uk-button-default">Назад</a>
    {!! html()->submit('Сохранить')->attribute('class', 'uk-button uk-button-primary') !!}
</div>

{!! html()->form()->close() !!}

<script>
    var bar = document.getElementById('js-progressbar');

    UIkit.upload('.js-upload', {
        url: '', // Укажите URL для загрузки
        multiple: true,

        beforeSend: function () {
            console.log('beforeSend', arguments);
        },
        beforeAll: function () {
            console.log('beforeAll', arguments);
        },
        load: function () {
            console.log('load', arguments);
        },
        error: function () {
            console.log('error', arguments);
        },
        complete: function () {
            console.log('complete', arguments);
        },
        loadStart: function (e) {
            console.log('loadStart', arguments);
            bar.removeAttribute('hidden');
            bar.max = e.total;
            bar.value = e.loaded;
        },
        progress: function (e) {
            console.log('progress', arguments);
            bar.max = e.total;
            bar.value = e.loaded;
        },
        loadEnd: function (e) {
            console.log('loadEnd', arguments);
            bar.max = e.total;
            bar.value = e.loaded;
        },
        completeAll: function () {
            console.log('completeAll', arguments);
            setTimeout(function () {
                bar.setAttribute('hidden', 'hidden');
            }, 1000);
            alert('Загрузка завершена');
        }
    });
</script>
@endsection

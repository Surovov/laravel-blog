@extends('admin.layout')

@section('content')
<div>
    <div class="uk-flex uk-flex-between uk-flex-middle uk-margin">
        <h3 class="uk-heading-bullet">Листинг постов</h3>
        <a href="{{ route('posts.create') }}" class="uk-button uk-button-primary">Добавить</a>
    </div>

    <table class="uk-table uk-table-striped uk-table-hover">
        <thead>
            <tr>
                <th class="uk-table-shrink">ID</th>
                <th class="uk-width-auto">Название</th>
                <th class="uk-width-auto">Категория</th>
                <th class="uk-width-auto">Теги</th>
                <th class="uk-width-small">Картинка</th>
                <th class="uk-width-small">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->getCategoryTitle() }}</td>
                <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                <td>
                    <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
                        <img src="{{ $post->getImage() }}" alt="" class="uk-width-small">
                    </div>
                </td>
                <td>
                    <a href="{{ route('posts.edit', $post->id) }}" uk-icon="icon: pencil"></a>
                    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="uk-icon-button" uk-icon="icon: trash" onclick="return confirm('Ты уверен?')"></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

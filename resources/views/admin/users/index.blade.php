@extends('admin.layout')

@section('content')
<div>
    <div class="uk-flex uk-flex-between uk-flex-middle uk-margin">
        <h3 class="uk-heading-bullet">Листинг пользователей</h3>
        <a href="{{ route('users.create') }}" class="uk-button uk-button-primary">Добавить</a>
    </div>

    <table class="uk-table uk-table-striped uk-table-hover">
        <thead>
            <tr>
                <th class="uk-table-shrink">ID</th>
                <th class="uk-width-small">Аватар</th>
                <th class="uk-width-auto">Имя</th>
                <th class="uk-width-auto">E-mail</th>
                <th class="uk-width-small">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>
                    <img src="{{ $user->getAvatar() }}" alt="" class="uk-preserve-width uk-border-circle tm-avatar" height="40" width="40">
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" uk-icon="icon: pencil"></a>
                    <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST" style="display:inline">
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

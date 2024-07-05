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
                <th class="uk-width-shrink">Действия</th>
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
                    @if($user->status == \App\Models\User::IS_ACTIVE)
                        <a href="{{ route('users.toggleBan', $user->id) }}" class="uk-icon-button" uk-icon="ban" ></a>
                    @else
                        <a href="{{ route('users.toggleBan', $user->id) }}" class="uk-icon-button" uk-icon="refresh" ></a>
                    @endif
                    @if($user->is_admin)
                        <a uk-icon="pull" href="{{ route('users.toggleAdmin', $user->id) }}" class="uk-icon-button"  ></a>
                    @else
                        <a uk-icon="push"  href="{{ route('users.toggleAdmin', $user->id) }}" class="uk-icon-button"></a>
                    @endif

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

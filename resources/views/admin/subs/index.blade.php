@extends('admin.layout')

@section('content')
<div>
    <div class="uk-flex uk-flex-between uk-flex-middle uk-margin">
        <h3 class="uk-heading-bullet">Список подписоты</h3>
        <a href="{{ route('subscriptions.create') }}" class="uk-button uk-button-primary">Добавить</a>
    </div>

    <table class="uk-table uk-table-striped uk-table-hover">
        <thead>
            <tr>
                <th class="uk-table-shrink">ID</th>
                <th class="uk-width-auto">Почта</th>
                <th class="uk-width-auto">Статус</th>
                <th class="uk-width-small">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subs as $sub)
            <tr>
                <td>{{ $sub->id }}</td>
                <td>{{ $sub->email }}</td>
                <td>
                	@if($sub->token == null)
	                    <div class="uk-flex uk-flex-middle"><span class="uk-margin-small-right" uk-icon="mail"></span><span> Активен</span></div>
                	@else
	                    <div class="uk-flex uk-flex-middle"><span class="uk-margin-small-right" uk-icon="ban"></span><span> Неактивен</span></div>
                	@endif
                </td>	
                <td>
                    <form action="{{ route('subscriptions.destroy', ['subscription' => $sub->id]) }}" method="POST" style="display:inline">
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

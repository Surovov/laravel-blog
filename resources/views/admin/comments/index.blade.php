@extends('admin.layout')

@section('content')
<div>
    <div class="uk-flex uk-flex-between uk-flex-middle uk-margin">
        <h3 class="uk-heading-bullet">Список комментов</h3>
    </div>

    <table class="uk-table uk-table-striped uk-table-hover">
        <thead>
            <tr>
                <th class="uk-table-shrink">ID</th>
                <th class="uk-width-auto">Текст</th>
                <th class="uk-width-small">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->text }}</td>
                <td>
                	@if($comment->status == 1)
	                    <a href="/admin/comments/toggle/{{$comment->id}}" uk-icon="icon: ban"></a>
                	@else
	                    <a href="/admin/comments/toggle/{{$comment->id}}" uk-icon="icon: check"></a>
                	@endif
                    <form action="{{ route('comments.destroy', ['id' => $comment->id]) }}" method="POST" style="display:inline">
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

@extends('admin.layout')

@section('content')
	<div class="">
	  <div class="uk-flex uk-flex-between uk-flex-middle">
	    <h3 class="uk-card-title">Categories List</h3>
	    <a href="{{ route('categories.create') }}" class="uk-button uk-button-primary">Add</a>
	  </div>
	  
	  <table class="uk-table uk-table-striped uk-table-divider uk-table-hover">
	    <thead>
	      <tr>
	        <th class="uk-table-shrink">ID</th>
	        <th class="uk-width-auto">Name</th>
	        <th class="uk-width-small">Actions</th>
	      </tr>
	    </thead>
	    <tbody>
	      @foreach($categories as $category)
	        <tr>
	          <td>{{ $category->id }}</td>
	          <td>{{ $category->title }}</td>
	          <td>
	            <a href="{{ route('categories.edit', $category->id) }}" uk-icon="icon: pencil"></a>
	            <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST" style="display:inline">
	              @csrf
	              @method('DELETE')
	              <button type="submit" class="uk-icon-button" uk-icon="icon: trash" onclick="return confirm('Are you sure you want to delete this item?')"></button>
	            </form>
	          </td>
	        </tr>
	      @endforeach
	    </tbody>
	  </table>
	</div>

@endsection
@extends('layouts.app')

@section('content')
	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
		Новости <a class="btn btn-success" href="{{ route('news.create') }}"> <<добавить</a>
	</h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
					@if ($message = Session::get('success'))
						<div class="alert alert-success">
							<p>{{ $message }}</p>
						</div>
					@endif
					@if ($message = Session::get('warning'))
						<div class="alert alert-warning">
							<p>{{ $message }}</p>
						</div>
					@endif
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    
					<table class="table table-bordered">
					<tr>
						<th>No</th>
						<th>Название</th>
						<th width="320px">Action</th>
					</tr>
					@foreach ($news as $new)
					<tr>
						<td>{{ ++$i }}</td>
						<td>{{ $new->name }}</td>
						<td>
							<form action="{{ route('news.destroy',$new->id) }}" method="POST">
			   
								<a class="btn btn-info" href="{{ route('news.show',$new->id) }}">Show</a>
			   
								@csrf
								@method('DELETE')
							
							</form>
						</td>
					</tr>
					@endforeach
				</table>
			  
				{!! $news->links() !!}
					
                </div>
            </div>
        </div>
    </div>
@endsection
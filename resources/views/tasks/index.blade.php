@extends('layouts.app')

@section('title', __('task.title'))

@section('content')
<div class="container"> 		
	<div class="row">
		<div class="col-md-6 offset-md-3">
			{!! Form::open([ 'route' => 'changeLanguage', 'method' => 'put']) !!}
				{!! Form::select('lang', 
					['vi' => 'Vietnamese', 'en' => 'English'], 
					session('lang'), 
					[
						'class' => 'custom-select',
						'id' => 'lang'
					])
				!!}
			{!! Form::close() !!}
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="#">Task Manager</a>
			</nav>
			{!! Form::open([ 'route' => 'tasks.store', 'method' => 'post']) !!}
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">@lang('task.form.title')</span>
				</div>
				{!! Form::text('name', null, 
						[
							'class' => 'form-control', 
							'placeholder' => __('task.form.title')
						]
				) !!}
			</div>
			{!! Form::submit(__('task.form.add'), 
					[
						'class' => [
									'btn btn-success d-block w-100'
									]
					]
				) 
			!!}
			{!! Form::close() !!}
				
			@if($errors->any())
				@foreach($errors->all() as $error)
					<div class="alert alert-danger mt-4">
						{{$error}}
					</div>
				@endforeach
			@endif

			@if($getAllTask->count() > 0)
				<ul class="list-group mt-5">
					@foreach($getAllTask as $task)
						<li class="list-group-item d-flex justify-content-between align-items-center">
							{{ $task->name }}

							{!! Form::open([ 
									'route' => ['tasks.destroy', 'task' => $task->id],
									'method' => 'delete'
								]) 
							!!}
								{!! Form::button(__('task.form.delete'), 
										[
											'class' => 'badge badge-primary badge-pill',
											'type' => 'submit'
										]
									) 
								!!}
							{!! Form::close() !!}

						</li>
					@endforeach
				</ul>
			@endif
		</div>
	</div>
</div>
@endsection

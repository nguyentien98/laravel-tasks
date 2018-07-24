@extends('layout')

@section('title', __('task.title'))

@section('content')
		

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
@endsection

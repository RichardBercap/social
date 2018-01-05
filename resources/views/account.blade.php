@extends('layouts.master')
@section('title')

@endsection

@section('content')
	<section class="row new-post">
		<div>
			<h3>Your Account</h3>
			<form action="{{ route('account.save')}}" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>First name</label>
					<input type="text" name="first_name" class="form-control" value="{{ $user->first_name}}">
				</div>
				<div class="form-group">
					<label>Image (Only jpg)</label>
					<input type="file" name="image" class="form-control" id="image" class="form-control">
				</div>
				<button type="submit" class="btn btn-primary">Save action</button>
				<input type="hidden" name="_token" value="{{Session::token()}}">
			</form>
		</div>
	</section>
	<!--   se esta guardando las imagenes pero no logre recuperrlas para mostrarlas   -->
	@if(Storage::disk('local')->has($user->first_name.'-'.$user->id.'.jpg'))
		<section class="row new-post">
			<div class="col-md-6 col-md-offset-3">
				<img src="{{ route('account.image',['filename'=>$user->first_name.'-'.$user->id.'.jpg'])}}" class="img-responsive">
			</div>
			<div>there is a image</div>
		</section>
	@endif
@endsection
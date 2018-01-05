@extends('layouts.master')
@section('content')
	@include('includes.message')
	<section class="row new-post">
		<div class="col-md-6 col-md-offset-3">
			<header>
				<h3>What do you have to say?</h3>
			</header>
			<form action="{{ route('post.create') }}" method="post">
				<div class="form-group">
					<textarea name="body" id="new-post" rows="5" class="form-control" placeholder="New Post">
						
					</textarea><br>
					<input type="hidden" name="_token" value="{{Session::token()}}">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</section>
	<section class="row posts">
		<div class="col-md-6 col-md-3-offset">
			<header><h3>Other people say...</h3></header>
			@foreach($posts as $post)
				<article class="post" data-postid="{{$post->id}}">
					<p>{{ $post->body }}</p>
					<div class="info">
						Posted by {{ $post->user->first_name}} on {{ $post->created_at}}
					</div>
					<div class="interaction">
						<a href="#" class="like">Like</a>│
						<a href="#" class="like">Dislike</a>│
						<!-- Cerificamos si el usuario creo el post-->
						@if(Auth::user()== $post->user)
							<a href=""  class="edit">Edit</a>│
							<a href="{{ route('post.delete', ['post_is'=>$post->id])}}">Delete</a>
						@endif
						
					</div>
				</article>
			@endforeach
			
			
		</div>
	</section>



<!-- Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        	{{ csrf_field() }}
        	<div class="form-group">
        		<label for="post-body">Edit the Post</label>
        		<textarea name="post-body" id="post-body" rows="5" class="form-control"></textarea>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	var token='{{ Session::token()}}';
	var url='{{route('edit')}}';
	var urlLike='{{route('like')}}';
</script>	
@endsection
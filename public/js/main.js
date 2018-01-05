var postId=0;
var postBodyElement=null;
$('.post').find('.interaction').find('.edit').on('click',function(event){
	event.preventDefault();

	postBodyElement=event.target.parentNode.parentNode.childNodes[1];
	var postBody=postBodyElement.textContent;
	//console.log(postBody);
	postId=event.target.parentNode.parentNode.dataset['postid'];
	$('#post-body').val(postBody);
	$('#edit-modal').modal();
});

$('#modal-save').on('click', function(){
	/*$.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "/edit",
      type: "POST"
    });
    $.ajax({
      data:{body:$('#post-body').val(), postId:postId, _token:token},
        success: function( msg ) {                        
                console.log(JSON.stringify(msg));                 
          }
        });*/
	$.ajax({
		method:'POST',
		url:url,
		data:{body:$('#post-body').val(), postId:postId, _token:token}
	})
	.done(function(msg){
		// funciona console.log(JSON.stringify(msg));
		$(postBodyElement).text(msg['new_body']);
		$('#edit-modal').modal('hide');
	});
});

//likes

$('.like').on('click',function(event){
	event.preventDefault();
	postId=event.target.parentNode.parentNode.dataset['postid'];
	var islike=event.target.previousElementSibling==null? true:false;
		$.ajax({
			method: 'POST',
			url:urlLike,
			data:{islike:islike, postId:postId, _token:token}
		})
		.done(function(){
			
		});

	});
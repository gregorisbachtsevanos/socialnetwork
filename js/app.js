// toggle forms
$("#new-account, #member").on('click', function(e){
	e.preventDefault();
	$('.login').toggleClass('hide');
	$('.signup').toggleClass('hide');
})

typeof sign_up !== "undefined" ? $("#member").click() : void(0);

// show comments
$('body').on('click', '.fa-comment', function(){
	let el = $(this).parent();
	el.find('.comment-info').slideToggle(600);
})

// delete posts
$('body').on('click', '.delete-feed', function(){
	let post = $(this).closest('.feed');
	$.post("../app/controllers/ajax/delete-post_controller.php", {postId: post.data('id')}, function(data){
		post.remove();
	})
})

// delete comment
$('body').on("click", ".delete-comment", function(){

	let comment = $(this).closest(".comment");
	$.post("../app/controllers/ajax/delete-post_controller.php", {
		commentId: comment.data("id"),
		feedId: comment.closest(".feed").data("id")
	}, function(res){
		let data = jQuery.parseJSON(res);
		comment.closest(".feed").find(".comment-count").html(data.total);
		comment.remove();
	});

})

// add comment
$('.feed').on("click", ".new-comment", function(){

	let post = $(this).closest(".feed");
	$.post("../app/controllers/ajax/new-comment_controller.php", {
		postId: post.data("id"),
		msg: post.find(".comment-field").val()
	}, function(res){
		let data = res;
		if (data.comment) {
			post.find(".comment-count").html(data.total);
			let addComment = `
				<div class="comment" data-id=${data.id}>
					<h4>${data.username} 
						<i class="far fa-trash-alt delete-comment"></i>
						</h4>
					<small>${data.date_created}</small>
					<p>${data.message}</p>
					<hr>
				</div>
			`;
			post.find(".post-comments").append(addComment);
		}
	})
	post.find(".comment-field").val('');

})

// add a like
$(".feed").on("click", ".fa-heart", function(){
	let post = $(this).closest('.feed');
	let postId = post.data("id");
	$.post("../app/controllers/ajax/like_controller.php", {postId: post.data("id")}, function(res){
		let data = jQuery.parseJSON(res);		
		if (data.liked) {
			post.find(".fa-heart").css("color", data.color);
			post.find(".likes").html(data.total);
		} else {
			post.find(".fa-heart").css("color", data.color);
			post.find(".likes").html(data.total);
		}
	})
})

// users action
function getUserActions(removeClass, addClass0, addClass1, addClass2){
	removeClass.removeClass("show-action");
	addClass0.addClass("show-action");
	addClass1.addClass("show-action");
	addClass2.addClass("show-action");
}	

$(".comment-action").click(() => getUserActions(
	$(".get-comments"), 
	$(".get-posts"), 
	$(".get-mentions"), 
	$(".get-likes")
));

$(".mention-action").click(() => getUserActions(
	$(".get-mentions"), 
	$(".get-comments"), 
	$(".get-posts"), 
	$(".get-likes")
));

$(".like-action").click(() => getUserActions(
	$(".get-likes"), 
	$(".get-comments"), 
	$(".get-posts"), 
	$(".get-mentions")
));

$(".post-action").click(() => getUserActions(
	$(".get-posts"), 
	$(".get-comments"), 
	$(".get-mentions"), 
	$(".get-likes")
));

// search form show
$(".fa-search").click(()=>
	$(".search").animate({ left: '0' }, "slow")
)

$(".fa-times").click(()=>
	$(".search").animate({left:'-30%'}, "slow")
)

$("#search-items .search-input").on('keypress',(e)=>{
		console.log(e.keyCode)
	$.post("../app/controllers/ajax/user-search_controler.php",{searchInput:$(e.target).val()}, function(res){
		let data = jQuery.parseJSON(res)
		console.log(data)
		for (user of data){
			let searchResult = 	`
				<div class="input-result">
					<img src="../files/assets/img/avatars/${user.avatar}" width="10%">	
					<h4>${user.fullname} <small><a href="../public/profile.php?id=${user.id}">@${user.username}</a></small></h4>
				</div>
				<hr>
			`;
			$(".results").append(searchResult)
		}
	})
})

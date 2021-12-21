// toggle forms
$("#new-account, #member").on('click', function(e){
	e.preventDefault();
	$('.login').toggleClass('hide');
	$('.signup').toggleClass('hide');
})

typeof sign_up !== "undefined" ? $("#member").click() : void(0);

// loading more posts
function loadPosts(post, appendTo) {
	let showComments = [];
	let comment = [];
	for (comment of post.comments) {
		showComments.push(
        /*html*/ `
			<div class="comment" data-id='${comment.id}'>
				<h4>
					${comment.username.username} 
					${comment.user_id == userId ? `<i class='far fa-trash-alt delete-comment' data-id='${post.post_id}'></i>` : ''}
				</h4>
				<small>${comment.date_created}</small>
				<p>${comment.message}</p>
				<hr>
			</div>`
		);
	}
	showPosts =
	/*html*/ `
		<div class="feed" data-id="${post.post_id}">
			<div class="feed-info">
				<div class="post-header">
					<a href='../public/profile.php?id=${post.user_id}'>
						<div class="users-info">
							<div class="users-avatar">
								${post.avatar}
							</div>
							<h4>${post.fullname} 
								<span> @${post.username}</span>
							</h4>
						</div>
					</a>
					${post.user_id == userId ? `<i class='far fa-trash-alt delete-feed' data-id='${post.post_id}'></i>` : ''}
				</div>
				<span class="date"><small>${post.date_created}</small></span>
				<hr>
			</div>

			<div class="feed-message">
				<p class="post-msg">${post.message}</p>
				<hr>
				<div class="reactions">
					<span class="fas fa-heart ${post.liked}">
						<small class="likes">${post.total_likes}</small>
					</span>  
					<div class="comment-body">
						<span class="fas fa-comment" id="${post.post_id}">
							<small class="comment-count">${post.total_comments}</small>
						</span>
						<div class="comment-info" data-id="${post.post_id}">
							<div class="post-comments">${post.post_id == comment.parent_id ? showComments.join(' ') : ''}</div>
							<input type="text" name="comment" class="comment-field" autocomplete="off" placeholder="Add a comment" required>
							<small class="new-comment">Comment</small>
						</div>
					</div>
				</div> 
			</div>
		</div>`
	;

	return appendTo.append(showPosts);
}

// first load posts
if(typeof PAGE != "undefined"){
	let time = 0

	if(PAGE == "homepage"){
		$.post("../app/controllers/ajax/show-posts_controller.php", {
			userId,
			page: PAGE
		}, function(res){
			// console.log(res);
			let data = jQuery.parseJSON(res);
			let showPosts = '';
			for (post of data.posts) {
				loadPosts(post, $("#feed-controller"));
			}
			$("#load-posts").on('click', function(e){
				e.preventDefault()
				$.post("../app/controllers/ajax/show-posts_controller.php", {
					userId,
					page: PAGE,
					counter: post.counter,
					postId: post.post_id
				}, function(res){
					// console.log(res);
					data = jQuery.parseJSON(res);
					showPosts = '';
					$("#load-posts").hide();
					$("#loader").show()
					setTimeout(function(){
						for (post of data.posts) {
							loadPosts(post, $("#feed-controller"));
							$("#load-posts").show();
							$("#loader").hide()
							clearInterval(time)
						}
						
					},500)
				})
			})

		})

	} else if(PAGE == "profile"){
		$.post("../app/controllers/ajax/show-posts_controller.php", {
			userId,
			page: PAGE
		}, function(res){
			// console.log(res);
			let data = jQuery.parseJSON(res);
			let showPosts = '';
			for (post of data.posts) {
				loadPosts(post, $(".users-posts"));
			}
			$("#load-posts").on('click', function(e){
				e.preventDefault()
				$.post("../app/controllers/ajax/show-posts_controller.php", {
					userId,
					page: PAGE,
					counter: post.counter,
					postId: post.post_id
				}, function(res){
					console.log(res);
					data = jQuery.parseJSON(res);
					showPosts = '';
					$("#load-posts").hide();
					$("#loader").show()
					// let time = ''
					setTimeout(function(){
						
						for (post of data.posts) {
							loadPosts(post, $(".users-posts"));
							$("#load-posts").show();
							$("#loader").hide()
						}
						
					},500)
				})
			})

		})
	}
}

// show comments
$('body').on('click', '.fa-comment', function(){
	let el = $(this).parent();
	el.find('.comment-info').slideToggle(400);
})

// delete posts
$('body').on('click', '.delete-feed', function(){
	let post = $(this).closest('.feed');
	$.post("../app/controllers/ajax/delete-post_controller.php", {
		postId: post.data('id')
	}, function(data){
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
$('body').on("click", ".new-comment", function(){

	let post = $(this).closest(".feed");
	$.post("../app/controllers/ajax/new-comment_controller.php", {
		postId: post.data("id"),
		msg: post.find(".comment-field").val()
	}, function(res){
		let data = res;
		if (data.comment) {
			post.find(".comment-count").html(data.total);
			let addComment = 
			/*html*/`
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
$("body").on("click", ".fa-heart", function(){
	let post = $(this).closest('.feed');
	$.post("../app/controllers/ajax/like_controller.php", {
		postId: post.data("id")
	}, function(res){
		let data = jQuery.parseJSON(res);		
		if (data.liked) {
			post.find(".likes").html(data.total);
			post.find(".fa-heart").css({"color": data.color,
										'transform': 'scale(1.1)',
										'font-weight': '700'}
									);
			setTimeout(() => {
				post.find(".fa-heart").css({'transform': 'scale(1)',
											'font-weight': '100'}
										);
			},50)
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
$(".fa-search").click(() => $(".search, .search-background").animate({ left: '0' }, "slow"));

$(".fa-times").click( function() {
	$(".search, .search-background").animate({left:'-30%'}, "slow");
	$(".search-input").val('');
	$(".input-result, hr").remove();
});

$("#search-items .search-input").on("keyup ", function(e){

	let userInput = $(this).val();
	
	$.post("../app/controllers/ajax/user-search_controler.php",{
		searchInput:userInput
	}, function(res){
		let data = jQuery.parseJSON(res);
	
		$(".results").html("")
		for (user of data){
			let searchResult = 	
			/*html*/`
			<div class="input-result">
				${user.avatar ? `<img style='width:100%;height:100%' src="../files/assets/img/avatars/${user.avatar}" alt='image-profile'></img>` : `<span>${user.fullname.charAt(0)}</span>`}
				<h4>${user.fullname} 
					<small>
						<a href="../public/profile.php?id=${user.id}">@${user.username}</a>
					</small>
				</h4>
			</div>
			<hr>
			`;
			$(".results").append(searchResult);
					
		}	
	
	})
})

// follow / unfollow
$(".user-container, #friends-container").on('click','.follow-btn', function() {
	
	$.post("../app/controllers/ajax/follow-unfollow_controller.php", {
		userId: $(this).closest(".user").data("id")
	}, function(res){
		console.log(res)
		let data = jQuery.parseJSON(res);
		if(data.followed){
			$('.follow-btn').html("unfollow");
			$("#followers").html(data.totalFollowers);
		}else{
			$('.follow-btn').html("follow");
			$("#followers").html(data.totalFollowers);
		}
	})

	if(($(this).parent().hasClass( "btns" ))){
		$(this).closest(".friend-card").remove()
	}
})

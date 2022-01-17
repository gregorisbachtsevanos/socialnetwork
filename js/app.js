// toggle forms (login-register)
$("#new-account, #member").on('click', function(e){
	// e.preventDefault();
	// $('.login').toggleClass('hide');
	// $('.signup').toggleClass('hide');
})

typeof sign_up !== "undefined" ? $("#member").click() : void(0);

// loading more posts
function loadPosts(post, appendTo, type="posts") {
	// console.log(type)
	let showComments = [];
	let comment = [];
	if(type == "posts" || type == "images"){

		for (comment of post.comments) {
			showComments.push(
			/*html*/ `
				<div class="comment" data-id='${comment.id}'>
					<h4>
						${comment.username.username} 
						${comment.username.username == CURRENT_USER ? `<i class='far fa-trash-alt delete-comment' data-id='${post.post_id}'></i>` : ''}
					</h4>
					<small>${comment.date_created}</small>
					<p>${comment.message}</p>
					<hr>
				</div>`
			);
		}
	}
	if(type == "posts"){
		showPosts =
		/*html*/ `
			<div class="feed" data-id="${post.post_id}">
				<div class="feed-info">
					<div class="post-header">
						<a href='../public/${post.username}'>
							<div class="users-info">
								<div class="users-avatar">
									${post.avatar}
								</div>
								<h4>${post.fullname} 
									<span> @${post.username}</span>
								</h4>
							</div>
						</a>
						${post.username == CURRENT_USER ? `<i class='far fa-trash-alt delete-feed' data-id='${post.post_id}'></i>` : ''}
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
		
	} else if (type == "images"){
		showPosts =
		/*html*/ `
			<div class="feed img-container" data-id="${post.post_id}">
				<div class="feed-info">
					<div class="post-header">
						<a href='../public/${post.username}'>
							<div class="users-info">
								<div class="users-avatar">
									${post.avatar}
								</div>
								<h4>${post.fullname} 
									<span> @${post.username}</span>
								</h4>
							</div>
						</a>
						${post.user_id == USERNAME ? `<i class='far fa-trash-alt delete-feed' data-id='${post.post_id}'></i>` : ''}
					</div>
					<span class="date"><small>${post.date_created}</small></span>
					<hr>
				</div>

				<div class="feed-message">
					<p class="post-msg">
						<img width="70%"src="../files/assets/img/avatars/${post.image}">
					</p>
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
		
	} else if (type == "followers"){
		showPosts =
		/*html*/
			`<div class="friend-card user" data-id="${post.id}">
				<div class="profile-img">
				${post.profileAvatar}
				</div>
				<div class="info">
					<h2>${post.fullname} <a href='../public/${post.username}'>@${post.username}</a></h2>
				</div>
				<div class="btns">
					<button class="follow-btn">unfollow</button>
					<button>Message</button>
				</div>
			</div>`
		;
	} else if (type == "following"){
		showPosts =
		/*html*/
			`<div class="friend-card user" data-id="${post.id}">
				<div class="profile-img">
				${post.profileAvatar}
				</div>
				<div class="info">
					<h2>${post.fullname} <a href='../public/${post.username}'>@${post.username}</a></h2>
				</div>
				<div class="btns">
					<!--<button class="follow-btn">unfollow</button>-->
					<button>Message</button>
				</div>
			</div>`
		;
	}
	return appendTo.append(showPosts);
}

// loading user's action
function loadUsersActions(PAGE, append, type="posts", limit=5) {
	$.post("../app/controllers/ajax/show-posts_controller.php", {
		USERNAME,
		page: PAGE,
		type:type,
		limit: limit
	}, function (res) {
		let data = jQuery.parseJSON(res);
		// console.log(data);
		// let showPosts = '';
		for (post of data.posts) {
			loadPosts(post, append, type);
		}
		let counter;
		data.posts.length > 0 ? counter = data.posts[data.posts.length-1].post_id : void(0)
	
		$(".load-posts").on('click', loadMore());
		$(".delete-feed").on('click', loadMore(1));

		function loadMore(limit=5) {
			return function (e) {
				e.preventDefault();
				$.post("../app/controllers/ajax/show-posts_controller.php", {
					USERNAME,
					counter,
					page: PAGE,
					type: type,
					limit: limit,
					postId: post.post_id
				}, function (res) {
					data = jQuery.parseJSON(res);
					// console.log(post.post_id);
					showPosts = '';
					$(".load-posts").hide();
					$(".loader").show();
					setTimeout(function () {

						for (post of data.posts) {
							loadPosts(post, append, type);
							$(".load-posts").show();
							$(".loader").hide();
						}
						if (data[0] == 0) {
							$(".loader").hide();
							$(".no-more-posts")
								.html(`There is no more ${type} to show.`)
								.css({ "padding-top": '3%', "padding-bottom": '7%' });
						}

					}, 500);
					data.posts.length > 0 ? counter = data.posts[data.posts.length - 1].post_id : void (0);

				});
			};
		}
	});
}

// first load (posts)
if(typeof PAGE != "undefined"){

	if(PAGE == "homepage"){
		loadUsersActions("homepage", $("#feed-controller"));
	} else if(PAGE == "profile"){
		loadUsersActions("profile", $(".users-posts"), "posts");
		
		// get users posts
		$(".post-action").click(() => toggleUserAction(
			$(".get-posts"), 
			$(".get-images"), 
			$(".get-followers"), 
			$(".get-following")
		));
		$(".post-action").click(() => loadUsersActions("profile", $(".users-posts"), "posts"));
		
		// get users images
		$(".image-action").click(() => toggleUserAction(
			$(".get-images"), 
			$(".get-followers"), 
			$(".get-posts"), 
			$(".get-following")
			));
		$(".image-action").click(() => loadUsersActions("profile", $(".users-images"), "images"));
		
		// get users followers
		$(".followers-action").click(() => toggleUserAction(
			$(".get-followers"), 
			$(".get-images"), 
			$(".get-posts"), 
			$(".get-following")
		));
		$(".followers-action").click(() => loadUsersActions("profile", $(".users-followers"), "followers"));
		
		// get users following
		$(".following-action").click(() => toggleUserAction(
			$(".get-following"), 
			$(".get-images"), 
			$(".get-followers"), 
			$(".get-posts")
		));
		$(".following-action").click(() => loadUsersActions("profile", $(".users-following"), "following"));
		
	}
}

$('body').on("click", '.post-msg', function(){
	let showPosts =
		/*html*/ `
			<div class="feed" data-id="${post.post_id}">
				<div class="feed-info">
					<div class="post-header">
						<a href='../public/${post.username}'>
							<div class="users-info">
								<div class="users-avatar">
									${post.avatar}
								</div>
								<h4>${post.fullname} 
									<span> @${post.username}</span>
								</h4>
							</div>
						</a>
						${post.username == CURRENT_USER ? `<i class='far fa-trash-alt delete-feed' data-id='${post.post_id}'></i>` : ''}
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
	// for (comment of post.comments) {
	// 	showComments.push(
	// 	/*html*/ `
	// 		<div class="comment" data-id='${comment.id}'>
	// 			<h4>
	// 				${comment.username.username} 
	// 				${comment.username.username == CURRENT_USER ? `<i class='far fa-trash-alt delete-comment' data-id='${post.post_id}'></i>` : ''}
	// 			</h4>
	// 			<small>${comment.date_created}</small>
	// 			<p>${comment.message}</p>
	// 			<hr>
	// 		</div>`
	// 	);
	// }
	$("#per-feed-controller").append(showPosts)
	window.location.href = `${APP_URL}feed?id=${($(this).closest(".feed").data("id"))}`;

})

// toggle comments
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

// comment system
$('body').on("click", ".new-comment", function(){

	let post = $(this).closest(".feed");
	$.post("../app/controllers/ajax/new-comment_controller.php", {
		postId: post.data("id"),
		msg: post.find(".comment-field").val()
	}, function(res){
		let data = res;
		if (data.comment) {
			post.find(".comment-count").html(data.total);

			post.find(".post-comments").append(
				/*html*/`
				<div class="comment" data-id=${data.id}>
					<h4>${data.username} 
						<i class="far fa-trash-alt delete-comment"></i>
					</h4>
					<small>${data.date_created}</small>
					<p>${data.message}</p>
					<hr>
				</div>`
			);
		}
	})
	post.find(".comment-field").val('');

})

// like system
$("body").on("click", ".fa-heart", function(){
	let post = $(this).closest('.feed');
	$.post("../app/controllers/ajax/like_controller.php", {
		postId: post.data("id")
	}, function(res){
		let data = jQuery.parseJSON(res);		
		if (data.liked) {
			post.find(".likes").html(data.total);
			post.find(".fa-heart")
				.css({
					"color": data.color,
					'transform': 'scale(1.1)',
					'font-weight': '700'
				});
			setTimeout(() => {
				post.find(".fa-heart")
					.css({
						'transform': 'scale(1)',
						'font-weight': '100'
					});
			},50)
		} else {
			post.find(".fa-heart").css("color", data.color);
			post.find(".likes").html(data.total);
		}
	})
});

// friends card
$.post("../app/controllers/ajax/load-friends_controller.php", {user: CURRENT_USER},
function(res){
	let data = jQuery.parseJSON(res)

	$('.friends-controller').append(
		/*html*/
		`<div class="friend-card user" data-id="">
			<div class="profile-img">${data.avatar}</div>
			<div class="info">
				<h2> ${data.fullname}<a href="../public/${data.username}">@${data.username}</a></h2>
			</div>
			<div class="btns">
				<button class="follow-btn">unfollow</button>
				<button>Message</button>
			</div>
		</div>`
	);
})

// toggle user's action
function toggleUserAction(removeClass, addClass0, addClass1, addClass2){
	removeClass.removeClass("show-action");
	removeClass.find(".feed, .friend-card").remove();
	addClass0.addClass("show-action");
	addClass1.addClass("show-action");
	addClass2.addClass("show-action");
}	

// toggle search form
$(".fa-search").click(() => $(".search, .search-background").animate({ left: '0' }, "slow"));

$(".fa-times").click( function() {
	$(".search, .search-background").animate({left:'-30%'}, "slow");
	$(".search-input").val('');
	$(".input-result, hr").remove();
});

$("#search-items .search-input").on("keyup ", function(){

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
				${user.avatar ? `<img style='width:35px;height:35px' src="../files/assets/img/avatars/${user.avatar}" alt='image-profile'></img>` : `<span>${user.fullname.charAt(0)}</span>`}
				<h4>${user.fullname} 
					<small>
						<a href='../public/${user.username}'>@${user.username}</a>
					</small>
				</h4>
			</div>
			<hr>
			`;
			$(".results").append(searchResult);
					
		}	
	
	})
})

// follow system
$(".user-container, #friends-container, .users-followers, .users-following").on('click','.follow-btn', function() {
	
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
	if(!$(this).closest(".friend-card").parent().hasClass("users-following")){
		if(($(this).parent().hasClass( "btns" ))){
			$(this).closest(".friend-card").remove()
		}
	}
})

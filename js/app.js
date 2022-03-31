// toggle forms (login-register)
$("#new-account, #member").on('click', function (e) {
	// e.preventDefault();
	// $('.login').toggleClass('hide');
	// $('.signup').toggleClass('hide');
})

typeof sign_up !== "undefined" ? $("#member").click() : void(0);

// loading more posts
function loadPosts(post, appendTo, type = "posts") {
	// console.log(type)
	let showComments = [];
	let comment = [];
	if (type == "posts" || type == "images") {

		for (comment of post.comments) {
			showComments.push(

				/*html*/
				`
				<div class="comment" data-id=${comment.id}>
					<div class="comment-header">
						<a href='../public/${comment.username.username}'>
							<h4>
								<div class="users-avatar">${comment.commentAvatar}</div>
								${comment.username.fullname} 
								<span>&nbsp;@${comment.username.username}<span>
							</h4>
						</a>
						${comment.username.username == CURRENT_USER ? `<i class='far fa-trash-alt delete-comment' data-id='${post.post_id}'></i>` : ''}
					</div>
				<small>${comment.date_created}</small>
				<hr>
				<p>${comment.message}</p>
				<hr>
			</div>`

			);
		}
	}
	if (type == "posts") {
		showPosts =
			/*html*/
			`
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
			</div>`;

	} else if (type == "images") {
		showPosts =
			/*html*/
			`
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
			</div>`;

	} else if (type == "followers") {
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
			</div>`;
	} else if (type == "following") {
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
			</div>`;
	}
	return appendTo.append(showPosts);
}

// loading user's action
function loadUsersActions(PAGE, appendTo, type = "posts", limit = 5) {
	$.post("../app/controllers/ajax/show-posts_controller.php", {
		USERNAME,
		page: PAGE,
		type: type,
		limit: limit
	}, function (res) {
		let data = jQuery.parseJSON(res);
		// console.log(data);
		// let showPosts = '';
		for (post of data.posts) {
			loadPosts(post, appendTo, type);
		}
		let counter;
		data.posts.length > 0 ? counter = data.posts[data.posts.length - 1].post_id : void(0)

		$(".load-posts").on('click', loadMore());
		$(".delete-feed").on('click', loadMore(1));

		function loadMore(limit = 5) {
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
							loadPosts(post, appendTo, type);
							$(".load-posts").show();
							$(".loader").hide();
						}
						if (data[0] == 0) {
							$(".loader").hide();
							$(".no-more-posts")
								.html(`There is no more ${type} to show.`)
								.css({
									"padding-top": '3%',
									"padding-bottom": '7%'
								});
						}

					}, 500);
					data.posts.length > 0 ? counter = data.posts[data.posts.length - 1].post_id : void(0);

				});
			};
		}
	});
}

function displayTrending(data, appendTo, type) {
	let showComments = [];
	let trendingPosts = ''
	if (type != 'users') {
		for (comment of data.comments) {
			showComments.push(
				/*html*/
				`
				<div class="comment" data-id=${comment.id}>
					<div class="comment-header">
						<a href='../public/${data}'>
							<h4>
								<div class="users-avatar">${comment.avatar}</div>
								${comment.fullname} 
								<span>&nbsp;@${comment.username}<span>
							</h4>
						</a>
						${comment.username == CURRENT_USER ? `<i class='far fa-trash-alt delete-comment' data-id='${data.post_id}'></i>` : ''}
					</div>
				<small>${comment.date_created}</small>
				<hr>
				<p>${comment.message}</p>
				<hr>
			</div>`

			);
		}
		data.message == null ?
			feed = `<img src=../files/assets/img/avatars/${data.image} width="100%" height="100%" alt="image-feed">` :
			feed = data.message
		trendingPosts =
			/*html*/
			`
			<div class="feed" data-id="${data.post_id}">
				<div class="feed-info">
					<div class="post-header">
						<a href='../public/${data.username}'>
							<div class="users-info">
								<div class="users-avatar">
									${data.avatar}
								</div>
								<h4>${data.fullname} 
									<span> @${data.username}</span>
								</h4>
							</div>
						</a>
						${data.username == CURRENT_USER ? `<i class='far fa-trash-alt delete-feed' data-id='${data.post_id}'></i>` : ''}
					</div>
					<span class="date"><small>${data.date_created}</small></span>
					<hr>
				</div>

				<div class="feed-message">
					<p class="post-msg">${feed}</p>
					<hr>
					<div class="reactions">
						<span class="fas fa-heart ${data.liked}">
							<small class="likes">${data.total_likes}</small>
						</span>  
						<div class="comment-body">
							<span class="fas fa-comment" id="${data.post_id}">
								<small class="comment-count">${data.total_comments}</small>
							</span>
							<div class="comment-info" data-id="${data.post_id}">
								<div class="post-comments">${typeof comment != "undefined" ? data.post_id == comment.parent_id ? showComments.join(' ') : '' : void(0)}</div>
								<input type="text" name="comment" class="comment-field" autocomplete="off" placeholder="Add a comment" required>
								<small class="new-comment">Comment</small>
							</div>
						</div>
					</div> 
				</div>
			</div>`;
	} else {
		trendingPosts =
			/*html*/
			`<div class="trending-card user" data-id="">
			<div class="profile-img">${data.avatar}</div>
			<div class="info">
				<h2> ${data.fullname}</h2>
				<a href="../public/${data.username}">@${data.username}</a>
				<p>${data.followers} followers</p>
				<p>${data.following} following</p>
			</div>
			
		</div>`
	}

	return appendTo.append(trendingPosts)
}

function loadTrending(type, appendTo) {
	$.post("../app/controllers/ajax/load-trendings_controller.php", {
		type: type,
		CURRENT_USER
	}, function (res) {
		// console.log(res)
		let data = jQuery.parseJSON(res)
		// console.log(data)
		for (dataResuls of data) {
			displayTrending(dataResuls, appendTo, type);
		}
	})
}

// toggle user's action
function toggleUserAction(removeClass, addClass0, addClass1, addClass2 = null) {
	removeClass.removeClass("show-action");
	removeClass.find(".feed, .friend-card").remove();
	addClass0.addClass("show-action");
	addClass1.addClass("show-action");
	if (addClass2 != null) {
		addClass2.addClass("show-action");
	}
}

function addCommentCall(post, el, value, appendTo) {

	$.post("../app/controllers/ajax/new-comment_controller.php", {
		postId: post.data('id'),
		msg: value
	}, function (res) {
		// console.log(res);
		let data = res;
		if (data.comment) {
			el.find(".comment-count").html(data.total);
			el.find(appendTo).append(
				/*html*/
				`
				<div class="comment" data-id=${data.id}>
					<div class="comment-header">
						<a href='../public/${data.username}>'>
							<h4>
								<div class="users-avatar">${data.avatar}</div>
								${data.fullname}&nbsp; <span>@${data.username} </span>
							</h4>
						</a>
							<p style="color: #d4d4d4"><i class="far fa-trash-alt delete-comment" data-id=${data.id}></i></p>
					</div>
					<small>${data.date_created}</small>
					<hr>
					<p>${data.message}</p>
					<hr>
				</div>`
			);
		}
	});
	el.find(".comment-field").val('');
}

// first load (posts)
if (typeof PAGE != "undefined") {

	if (PAGE == "homepage") {
		loadUsersActions("homepage", $("#feed-controller"));
	} else if (PAGE == "profile") {
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

	} else if (PAGE == "trending") {
		loadTrending('users', $(".trending-users-container"));

		$('.trending-users').click(() => loadTrending('users', $(".trending-users-container")));
		$(".trending-users").click(() => toggleUserAction(
			$(".trending-users-container"),
			$(".trending-posts-container"),
			$(".trending-images-container")
		));

		$('.trending-post').click(() => loadTrending('posts', $(".trending-posts-container")));
		$(".trending-post").click(() => toggleUserAction(
			$(".trending-posts-container"),
			$(".trending-users-container"),
			$(".trending-images-container")
		));

		$('.trending-images').click(() => loadTrending('images', $(".trending-images-container")));
		$(".trending-images").click(() => toggleUserAction(
			$(".trending-images-container"),
			$(".trending-posts-container"),
			$(".trending-users-container")
		));
	}
}

// redirect to the feed page 
$('body').on("click", '.post-msg', function () {

	if (window.location.href == `${APP_URL}homepage`) {
		window.location.href = `${APP_URL}feed?id=${($(this).closest(".feed").data("id"))}`;
	}

})

// toggle comments
$('body').on('click', '.fa-comment', function () {
	let el = $(this).parent();
	el.parent().is('#comment-per-feed') ? void(0) : el.find('.comment-info').slideToggle(400)
})

// delete posts
$('body').on('click', '.delete-feed', function () {
	let post = $(this).closest('.feed');
	$.post("../app/controllers/ajax/delete-post_controller.php", {
		postId: post.data('id')
	}, function (data) {
		post.remove();
	})
})

// delete comment
$('body').on("click", ".delete-comment", function () {
	let comment = $(this).closest(".comment");
	$.post("../app/controllers/ajax/delete-post_controller.php", {
		commentId: comment.data("id"),
		feedId: comment.closest(".feed").data("id")
	}, function (res) {
		let data = jQuery.parseJSON(res);
		comment.parent().is('.post-comments') ?
			comment.closest(".feed").find(".comment-count").html(data.total) :
			$("body").find(".comment-count").html(data.total);
		comment.remove();
		if ($("body").find('.comment-container').hasClass("feed")) {
			if ($(".comment-container").children().length == 0) {
				$("body").find(".down-arrow").remove();
			}
		}
	});

})

// comment system
$('body').on("click", ".new-comment", function () {

	$(this).parent().is('.comment-info') ?
		addCommentCall(
			($(this).closest(".feed")),
			($(this).closest(".feed")),
			($(this).closest(".feed")).find(".comment-field").val(),
			".post-comments"
		) :
		addCommentCall(
			($('body').find("#feed")),
			($('body')),
			($('body')).find(".comment-field").val(),
			".comment-container"
		)
	$('body')
		.find("#arrow-icon")
		.empty()
		.append(`<p class="down-arrow"><i class="fas fa-level-down-alt"></i></p>`);

	// comment function
})

// like system
$("body").on("click", ".fa-heart", function () {
	let post = $(this).closest('.feed');
	$.post("../app/controllers/ajax/like_controller.php", {
		postId: post.data("id")
	}, function (res) {
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
			}, 50)
		} else {
			post.find(".fa-heart").css("color", data.color);
			post.find(".likes").html(data.total);
		}
	})
});

// friends card
if(typeof CURRENT_USER != 'undefined'){
	$.post("../app/controllers/ajax/load-friends_controller.php", {
			user: CURRENT_USER
		},
		function (res) {
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
		}
	)
}

// toggle search form
$(".form-search").click(() => $(".search, .search-background").animate({
	left: '0'
}, "slow"));

// search close animation
$(".fa-times").click(function () {
	$(".search, .search-background").animate({
		left: '-30%'
	}, "slow");
	$(".search-input").val('');
	$(".input-result, hr").remove();
});

// search results
$("#search-items .search-input").on("keyup ", function () {

	let userInput = $(this).val();

	$.post("../app/controllers/ajax/user-search_controler.php", {
		searchInput: userInput
	}, function (res) {
		let data = jQuery.parseJSON(res);

		$(".results").html("")
		for (user of data) {
			let searchResult =
				/*html*/
				`
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
$(".user-container, #friends-container, .users-followers, .users-following").on('click', '.follow-btn', function () {

	$.post("../app/controllers/ajax/follow-unfollow_controller.php", {
		userId: $(this).closest(".user").data("id")
	}, function (res) {
		// console.log(res)
		let data = jQuery.parseJSON(res);
		if (data.followed) {
			$('.follow-btn').html("unfollow");
			$("#followers").html(data.totalFollowers);
		} else {
			$('.follow-btn').html("follow");
			$("#followers").html(data.totalFollowers);
		}
	})
	if (!$(this).closest(".friend-card").parent().hasClass("users-following")) {
		if (($(this).parent().hasClass("btns"))) {
			$(this).closest(".friend-card").remove()
		}
	}
})

// feed display
let text = ''
let cls = ''
const accepted_chars = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'Α', 'Β', 'Γ', 'Δ', 'Ε', 'Ζ', 'Η', 'Θ', 'Ι', 'Κ', 'Λ', 'Μ', 'Ν', 'Ξ', 'Ο', 'Π', 'Ρ', 'Σ', 'Τ', 'Υ', 'Φ', 'Χ', 'Ψ', 'Ω', 'α', 'β', 'γ', 'δ', 'ε', 'ζ', 'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω', 'ς', '#', '@', '!', '$', '€', '%', ',', '.', '/', '?', ';', ':', '_', '-', '+', '*', '"', "'", '~', '(', ')', '[', ']', '<', '>', '{', '}', ' ', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

// e.key.search(accepted_chars)
// const accepted_chars = /[A-Z]/g;
$('#new-feed, #display-feed').on('paste copy cut', (e) => {
	e.preventDefault()
})
$('#new-feed').on('keydown', (e) => {
	switch (e.key) {
		case "#":
			if (accepted_chars.includes(e.key)) {
				cls = 'hastag';
				text += `<span class='${cls}'>${e.key}</span>`;
				break;
			}
			break;
		case '@':
			if (accepted_chars.includes(e.key)) {
				cls = 'mention';
				text += `<span class='${cls}'>${e.key}</span>`;
				break;
			}
			break;
		case ' ':
			if (accepted_chars.includes(e.key)) {
				cls = '';
				text += `<span class='${cls}'>${e.key}</span>`;
				break;
			}
			break;
		case 'Backspace':
			e.target.selectionStart == $('#new-feed').val().length
				? text = `<span class='${cls}'>${$('#new-feed').val().slice(0, -1)}</sp>`
				: e.preventDefault();
			
			break;
		default:
			if (accepted_chars.includes(e.key)) {
				text += `<span class='${cls}'>${e.key}</span>`;
			}
	}

	$("#display-feed").html(text)
})



particlesJS('particles-js',
  
  {
    "particles": {
      "number": {
        "value": 80,
        "density": {
          "enable": true,
          "value_area": 800
        }
      },
      "color": {
        "value": "#fdb9ef"
      },
      "shape": {
        "type": "circle",
        "stroke": {
          "width": 0,
          "color": "#cc4a7c"
        },
        "polygon": {
          "nb_sides": 5
        },
        "image": {
          "src": "img/github.svg",
          "width": 100,
          "height": 100
        }
      },
      "opacity": {
        "value": 0.5,
        "random": false,
        "anim": {
          "enable": false,
          "speed": 1,
          "opacity_min": 0.1,
          "sync": false
        }
      },
      "size": {
        "value": 3,
        "random": true,
        "anim": {
          "enable": false,
          "speed": 40,
          "size_min": 0.1,
          "sync": false
        }
      },
      "line_linked": {
        "enable": true,
        "distance": 150,
        "color": "#cc4a7c",
        "opacity": 0.4,
        "width": 1
      },
      "move": {
        "enable": true,
        "speed": 6,
        "direction": "none",
        "random": false,
        "straight": false,
        "out_mode": "out",
        "attract": {
          "enable": false,
          "rotateX": 600,
          "rotateY": 1200
        }
      }
    },
    "interactivity": {
      "detect_on": "canvas",
      "events": {
        "onhover": {
          "enable": true,
          "mode": "repulse"
        },
        "onclick": {
          "enable": true,
          "mode": "push"
        },
        "resize": true
      },
      "modes": {
        "grab": {
          "distance": 400,
          "line_linked": {
            "opacity": 1
          }
        },
        "bubble": {
          "distance": 400,
          "size": 50,
          "duration": 2,
          "opacity": 8,
          "speed": 3
        },
        "repulse": {
          "distance": 200
        },
        "push": {
          "particles_nb": 4
        },
        "remove": {
          "particles_nb": 2
        }
      }
    },
    "retina_detect": true,
    "config_demo": {
      "hide_card": false,
      "background_color": "#cc4a7c",
      "background_image": "",
      "background_position": "50% 50%",
      "background_repeat": "no-repeat",
      "background_size": "cover"
    }
  }

);
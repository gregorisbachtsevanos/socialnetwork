const homepage = "http://localhost/socialnetwork/public/homepage.php";
const index = "http://localhost/socialnetwork/public/index.php";
const profile = `http://localhost/socialnetwork/public/profile.php`;

// toggle forms
$("#new-account, #member").on('click', function(e){
	e.preventDefault();
	$('.login').toggleClass('hide')
	$('.singup').toggleClass('hide')
})

typeof signup !== "undefined" ? $("#member").click() : void(0);


// show comments
$('body').on('click', '.fa-comment', function(e){
	let el = $(this).parent()
	el.find('.comment-info').toggleClass('hide-comments');
})

// delete posts
$('body').on('click', '.delete-feed', function(e){
	let post = $(this).closest('.feed');
	let postId = post.data('id');
	$.post("../app/controllers/ajax/delete-post_controller.php", {postId: postId}, function(data){
		post.remove();
	})
})

// delete comment
$('body').on("click", ".delete-comment", function(e){
	let comment = $(this).closest(".comment");
	let commentId = comment.data("id");
	console.log(commentId)
	$.post("../app/controllers/ajax/delete-post_controller.php", {commentId: commentId}, function(data){
		comment.remove();
		comment.closest(".feed").find(".comment-count").html(data.total);

	})
})


$('.feed').on("click", ".new-comment", function(e){
	let post = $(this).closest(".feed");
	let postId = post.data("id");
	let msg = post.find(".comment-field").val()
	$.post("../app/controllers/ajax/new-comment_controller.php", {postId: postId, msg: msg}, function(res){
		let data = res
		if (data.comment) {
			post.find(".comment-count").html(data.total);
			insertComment(data, post);
		} else {
			post.find(".comment-count").html(data.total);
		};
	})
	post.find(".comment-field").val('')
})

$(".feed").on("click", ".fa-heart", function(e){
	let post = $(this).closest('.feed');
	let postId = post.data("id");
	e.preventDefault();
	$.post("../app/controllers/ajax/like_controller.php", {postId: postId}, function(res){
		let data = jQuery.parseJSON(res)		
		if (data.liked) {
			post.find(".fa-heart").css("color", data.color);
			post.find(".likes").html(data.total);
		} else {
			post.find(".fa-heart").css("color", data.color);
			post.find(".likes").html(data.total);
		}
	})
})


function insertComment(data, post) {
	const div = document.createElement("div");
	const hr = document.createElement("hr");
	const h4 = document.createElement("h4");
	const i = document.createElement("i");
	const small = document.createElement("small");
	const p = document.createElement("p");
	div.className = "comment";
	// div.setAttribute("data-id",);
	h4.innerHTML = data.username;
	i.className = "far fa-trash-alt delete-comment";
	small.innerHTML = data.date_created;
	p.innerHTML = data.message;
	h4.append(i)
	div.append(h4, small, p);
	post.find(".post-comments").append(div, hr);
}

// const getUserActions = (removeClass, addClass0, addClass1, addClass2)=>{
// 	removeClass.classList.remove("show-action");
// 	addClass0.classList.add("show-action");
// 	addClass1.classList.add("show-action");
// 	addClass2.classList.add("show-action");
// }	


// const likeBtns = document.querySelectorAll(".fa-heart");
// const commentBtns = document.querySelectorAll(".new-comment");
// const showComments = document.querySelectorAll(".fa-comment");
// const deletePosts = document.querySelectorAll(".delete-feed");
// var deleteComments = document.querySelectorAll(".delete-comment");

// const getPosts = document.querySelector(".get-posts");
// const getComments = document.querySelector(".get-comments");
// const getMentions = document.querySelector(".get-mentions");
// const getLikes = document.querySelector(".get-likes");

// //homepage)
// 	addLikeBtn();
// 	addCommentBtn();
// 	deleteComment();
	



// 	document.querySelector(".comment-action").addEventListener("click",	() => {
// 		getUserActions(getComments, getPosts, getMentions, getLikes)
// 	});
// 	document.querySelector(".mention-action").addEventListener("click",	() => {
// 		getUserActions(getMentions, getComments, getPosts, getLikes)
// 	});
// 	document.querySelector(".like-action").addEventListener("click", () => {
// 		getUserActions(getLikes, getComments, getPosts, getMentions)
// 	});
// 	document.querySelector(".post-action").addEventListener("click", () => {
// 		getUserActions(getPosts, getComments, getMentions, getLikes)
// 	});
 
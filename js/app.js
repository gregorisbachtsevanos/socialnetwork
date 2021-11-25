const homepage = "http://localhost/socialnetwork/public/homepage.php";
const index = "http://localhost/socialnetwork/public/index.php";
const profile = `http://localhost/socialnetwork/public/profile.php`;

const toggleForms = (e) => {
    e.preventDefault();
    document.querySelector(".login").classList.toggle("hide");
    document.querySelector(".singup").classList.toggle("hide");  
}

const mouseOver = (e) => {
	post = e.target.closest(".feed");
	(e.target.classList.contains("delete-feed")) ? post.querySelector(".delete-feed").style.color = "#fc6d26be" : post.querySelector(".delete-comment").style.color = "#fc6d26be";
}

const mouseOut = (e) => {
	post = e.target.closest(".feed");
	(e.target.classList.contains("delete-feed")) ? post.querySelector(".delete-feed").style.color = "#dadada" : post.querySelector(".delete-comment").style.color = "#dadada";
}

function toggleComments() {
	for (comment of showComments) {

		comment.addEventListener("click", (e) => {
			let post = e.target.closest(".feed");
			e.target.querySelector(".comment-info").classList.toggle("hide-comments");
			e.preventDefault();
		});
	}
}

function addLikeBtn() {
	for (likeBtn of likeBtns) {

		let post = likeBtn.closest('.feed');
		let postId = post.dataset.id;

		likeBtn.addEventListener("click", (e) => {
			e.preventDefault();
			xhr = new XMLHttpRequest();
			xhr.open("POST", `../app/controllers/ajax/like_controller.php`, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.onload = function (data) {
				if (xhr.status == 200) {
					let data = JSON.parse(this.responseText);

					if (data.liked) {
						post.querySelector(".fa-heart").style.color = data.color;
						post.querySelector(".likes").innerHTML = data.total;
					} else {
						post.querySelector(".fa-heart").style.color = data.color;
						post.querySelector(".likes").innerHTML = data.total;
					}
				}
			};
			xhr.send(`postId=${postId}`);
		});
	}
}

function addCommentBtn() {
	for (commentBtn of commentBtns) {
		let post = commentBtn.closest(".feed");
		let postId = post.dataset.id;
		commentBtn.addEventListener("click", (e) => {

			let msg = post.querySelector(".comment-field").value;
			console.log(msg);
			if (!msg.trim().length == 0) {

				e.preventDefault();
				xhr = new XMLHttpRequest();
				xhr.open("POST", "../app/controllers/ajax/new-comment_controller.php", true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr.onload = function (data) {
					if (this.status == 200) {
						let data = JSON.parse(this.responseText);
						if (data.comment) {
							post.querySelector(".comment").innerHTML = data.total;
							insertComment(data, post);
						}
					}
				};
				xhr.send(`postId=${postId}&msg=${msg}`);
			}
			post.querySelector(".comment-field").value = '';
		});
	}
}

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
	post.querySelector(".post-comments").append(div, hr);
}

function deletePost() {
	for (deletePost of deletePosts) {
		let param = ".fa-trash-alt";
		deletePost.addEventListener("mouseover", mouseOver);
		deletePost.addEventListener("mouseout", mouseOut);

		deletePost.addEventListener("click", (e) => {
			let post = e.target.closest('.feed');
			let postId = post.dataset.id;
			post.remove();
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "../app/controllers/ajax/delete-post_controller.php", true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

			xhr.onload = function () {
				if (this.status == 200) {
					// console.log(this.responseText)
				}
			};
			xhr.send(`postId=${postId}`);

		});
	}
}

function deleteComment() {
	for (deleteComment of deleteComments) {
		deleteComment.addEventListener("mouseover", mouseOver);
		deleteComment.addEventListener("mouseout", mouseOut);

		deleteComment.addEventListener("click", (e) => {
			let comment = deleteComment.closest(".comment");
			comment.remove();
			let commentId = comment.dataset.id;
			console.log(commentId);
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "../app/controllers/ajax/delete-post_controller.php", true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.onload = function () {
				if (this.status == 200) {
					console.log(this.responseText);
				}
			};
			xhr.send(`commentId=${commentId}`);
		});
	}
}

const likeBtns = document.querySelectorAll(".fa-heart");
const commentBtns = document.querySelectorAll(".new-comment");
const showComments = document.querySelectorAll(".fa-comment");
const deletePosts = document.querySelectorAll(".delete-feed");
const deleteComments = document.querySelectorAll(".delete-comment");

if(window.location.href == homepage){

	deletePost();
    addLikeBtn();
	toggleComments();
	addCommentBtn();
	deleteComment();

}else if(window.location.href == index){
    document.querySelector("#new-account").addEventListener("click", (e) => toggleForms(e));
    document.querySelector("#member").addEventListener("click", (e) => toggleForms(e));
    (sing_up !== undefined) ? document.querySelector("#member").click() : void(0);
}else{

	deletePost();
    addLikeBtn();
	toggleComments();
	addCommentBtn();
	deleteComment();

}








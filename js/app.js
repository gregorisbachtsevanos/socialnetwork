const homepage = "http://localhost/socialnetwork/public/homepage.php";
const index = "http://localhost/socialnetwork/public/index.php";

const toggleForms = (e) => {
    e.preventDefault();
    document.querySelector(".login").classList.toggle("hide");
    document.querySelector(".singup").classList.toggle("hide");  
}

function insertComment(data, post) {
	const div = document.createElement("div");
	const hr = document.createElement("hr");
	const h4 = document.createElement("h4");
	const small = document.createElement("small");
	const p = document.createElement("p");
	h4.innerHTML = data.username;
	small.innerHTML = data.date_created;
	p.innerHTML = data.message;
	div.append(h4, small, p);
	post.querySelector(".post-comments").append(div, hr);
}

const likeBtns = document.querySelectorAll(".fa-heart");
const commentBtns = document.querySelectorAll(".new-comment");
const showComments = document.querySelectorAll(".fa-comment");
const deletePosts = document.querySelectorAll(".fa-trash-alt");

if(window.location.href == homepage){

	// add a like
    for(likeBtn of likeBtns){

        let post = likeBtn.closest('.feed');
        let postId = post.dataset.id;

        likeBtn.addEventListener("click", (e) => {
            e.preventDefault();
            xhr = new XMLHttpRequest();
            xhr.open("POST", `../app/controllers/ajax/like_controller.php`, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function (data){
                if(xhr.status == 200){
                    let data = JSON.parse(this.responseText);
                   
                    if(data.liked){
						post.querySelector(".fa-heart").style.color = data.color;

                        post.querySelector(".likes").innerHTML = data.total;        
                    }else{
                        post.querySelector(".fa-heart").style.color = data.color;
                        post.querySelector(".likes").innerHTML = data.total;
                    }
                }
            }
            xhr.send(`postId=${postId}`);
        })
    }

	// show comments
	for(comment of showComments){

		comment.addEventListener("click", (e) => {
			let post = e.target.closest(".feed");
			console.log(post)
			e.target.querySelector(".comment-info").classList.toggle("hide-comments");
			e.preventDefault();
		})
	}

	// add new comment
	for(commentBtn of commentBtns){
		let post = commentBtn.closest(".feed");
		let postId = post.dataset.id;
		commentBtn.addEventListener("click", (e)=>{
			
			let msg = post.querySelector(".comment-field").value;
			console.log(msg)
			if(!msg.trim().length == 0){
				
				e.preventDefault();
				xhr = new XMLHttpRequest();
				xhr.open("POST", "../app/controllers/ajax/new-comment_controller.php", true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr.onload = function(data){
					if(this.status == 200){
						let data = JSON.parse(this.responseText);
						if(data.comment){
							post.querySelector(".comment").innerHTML = data.total;
							insertComment(data, post);
						}
					}
				}
				xhr.send(`postId=${postId}&msg=${msg}`);
			}
			post.querySelector(".comment-field").value = '';
		})
	}

	// delete post
	const mouseOver = (e) => {
		post = e.target.closest(".feed");
		post.querySelector(".fa-trash-alt").style.color = "#fc6d26be";
	}
	const mouseOut = (e) => {
		post = e.target.closest(".feed");
		post.querySelector(".fa-trash-alt").style.color = "#dadada";
	}

	for(deletePost of deletePosts){
		deletePost.addEventListener("mouseover", mouseOver);
		deletePost.addEventListener("mouseout", mouseOut);

		deletePost.addEventListener("click", (e) => {
			let post = e.target.closest('.feed');
			let postId = post.dataset.id
			post.remove();
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "../app/controllers/ajax/delete-post_controller.php", true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

			xhr.onload = function(){
				if(this.status == 200){
					console.log(this.responseText)
				}
			}
			xhr.send(`postId=${postId}`)
			
		});
	}

} else if(window.location.href == index){
    document.querySelector("#new-account").addEventListener("click", (e) => toggleForms(e));
    document.querySelector("#member").addEventListener("click", (e) => toggleForms(e));
    (sing_up !== undefined) ? document.querySelector("#member").click() : void(0);
}
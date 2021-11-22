const homepage = "http://localhost/socialnetwork/public/homepage.php";
const index = "http://localhost/socialnetwork/public/index.php";

const toggleForms = (e) => {
    e.preventDefault();
    document.querySelector(".login").classList.toggle("hide");
    document.querySelector(".singup").classList.toggle("hide");  
}

const likeBtns = document.querySelectorAll(".fa-heart");
const commentBtns = document.querySelectorAll(".new-comment");
const showComments = document.querySelectorAll(".fa-comment");

if(window.location.href == homepage){

    for(likeBtn of likeBtns){

        let post = likeBtn.parentElement.parentElement;
        let postId = post.dataset.id

        likeBtn.addEventListener("click", (e) => {
            e.preventDefault();
            xhr = new XMLHttpRequest();
            xhr.open("POST", `../app/controllers/ajax/like-controller.php`, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function (data){
                if(xhr.status == 200){
                    let data = JSON.parse(this.responseText)
                   
                    if(data.liked){
                        e.target.style.color = data.color    
                        e.target.querySelector("small").innerHTML = data.total;        
                    }else{
                        e.target.style.color = data.color
                        e.target.querySelector("small").innerHTML = data.total;
                    }
                }
            }
            xhr.send(`postId=${postId}`);
        })
    }

	// show comments
	for(comment of showComments){
		comment.addEventListener("click", (e) => {
			e.target.querySelector(".comment-info").classList.toggle("hide-comments");
			e.preventDefault();
		})
	}

	// add new comment
	for(commentBtn of commentBtns){
		let post = commentBtn.parentElement;
		let postId = post.dataset.id;
		commentBtn.addEventListener("click", (e)=>{

			let msg = e.target.parentElement.querySelector(".comment-field").value;
			if(!msg.trim().length == 0){
			console.log(post)
				
				e.preventDefault();
				xhr = new XMLHttpRequest();
				xhr.open("POST", "../app/controllers/ajax/new-comment-controller.php", true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr.onload = function(data){
					if(this.status == 200){
						let data = JSON.parse(this.responseText);
						if(data.comment){
							post.parentElement.querySelector("small").innerHTML = data.total;
							post.parentElement.querySelector("h4").innerHTML = data.status;
						}
					}
				}
				xhr.send(`postId=${postId}&msg=${msg}`);
			}
			e.target.parentElement.querySelector(".comment-field").value = '';
		})
	}

} else if(window.location.href == index){
    document.querySelector("#new-account").addEventListener("click", (e) => toggleForms(e));
    document.querySelector("#member").addEventListener("click", (e) => toggleForms(e));
    (sing_up !== undefined) ? document.querySelector("#member").click() : void(0);
}



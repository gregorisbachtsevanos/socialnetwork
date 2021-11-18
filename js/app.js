const homepage = "http://localhost/socialnetwork/public/homepage.php";
const index = "http://localhost/socialnetwork/public/index.php";

const toggleForms = (e) => {
    e.preventDefault();
    document.querySelector(".login").classList.toggle("hide");
    document.querySelector(".singup").classList.toggle("hide");  
}

const toggleComments = () => {
    document.querySelector("#comments-container").classList.toggle("hide-comments");  
}

const likeBtns = document.querySelectorAll(".fa-heart");

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


} else if(window.location.href == index){
    document.querySelector("#new-account").addEventListener("click", (e) => toggleForms(e));
    document.querySelector("#member").addEventListener("click", (e) => toggleForms(e));
    (sing_up !== undefined) ? document.querySelector("#member").click() : void(0);
}
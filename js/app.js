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

const liked = () => {
    likeBtn.style.color ="#fc6d26be";
}

const likeBtn = document.querySelector(".fa-heart");

if(window.location.href == homepage){
    // document.querySelector(".fa-comment").addEventListener("click", () => toggleComments());
    // likeBtn.addEventListener("click", () => liked());

    likeBtn.addEventListener("click", (e) => {
        e.preventDefault();

        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../app/ajax/like.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(data);

    });

} else if(window.location.href == index){
    document.querySelector("#new-account").addEventListener("click", (e) => toggleForms(e));
    document.querySelector("#member").addEventListener("click", (e) => toggleForms(e));
    (sing_up !== undefined) ? document.querySelector("#member").click() : void(0);
}
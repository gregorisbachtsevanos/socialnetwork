// const toggleClass = (e) => {
//     e.preventDefault();
//     document.querySelector(".login").classList.toggle("hide");
//     document.querySelector(".singup").classList.toggle("hide");  
// }

const homepage = "http://localhost/socialnetwork/public/homepage.php";
const index = "http://localhost/socialnetwork/public/index.php";
if(window.location.href == homepage){

    document.querySelector(".fa-comment").addEventListener("click", () => {
        document.querySelector("#comments-container").classList.toggle("hide-comments");  
    })

} else {

    const toggleClass = (e) => {
        e.preventDefault();
        document.querySelector(".login").classList.toggle("hide");
        document.querySelector(".singup").classList.toggle("hide");  
    }
    
    document.querySelector("#new-account").addEventListener("click", (e) => toggleClass(e));
    document.querySelector("#member").addEventListener("click", (e) => toggleClass(e));
    (sing_up !== undefined) ? document.querySelector("#member").click() : void(0)
}

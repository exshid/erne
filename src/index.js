import "../css/style.scss"

let searchButton = document.querySelectorAll(".search-submit");
if (searchButton !== null) {

    for (let search of searchButton) {
        search.classList.add("visuallyhidden")
    }
}

let authorLabel = document.querySelector(".comment-form-author label");
let emailLabel = document.querySelector(".comment-form-email label");
let urlLabel = document.querySelector(".comment-form-url label");

let commentEmail = document.querySelector(".comment-form-email input");
let commentAuthor = document.querySelector(".comment-form-author input");

let commentUrl = document.querySelector(".comment-form-url input");
if (commentUrl !== null) {

    authorLabel.classList.add("visuallyhidden")
    emailLabel.classList.add("visuallyhidden")
    urlLabel.classList.add("visuallyhidden")
    commentUrl.setAttribute("placeholder", "Website")
    commentAuthor.setAttribute("placeholder", "Name*")
    commentEmail.setAttribute("placeholder", "Email*")
}
/**
 * Pridava elementum classy pro zapnuti Dark mode.
 */
function dark(){
    document.body.classList.add("nightBody");
    document.querySelector(".box").classList.add("nightBox");
    document.querySelector("#username").classList.add("nightBox");
    document.querySelector("#password").classList.add("nightBox");
    document.querySelector("#confirmPsw").classList.add("nightBox");
    document.querySelector("#email").classList.add("nightBox");
}

/**
 * Odebira elementum classy pro vypnuti Dark mode.
 */
function light(){
    document.body.classList.remove("nightBody");
    document.querySelector(".box").classList.remove("nightBox");
    document.querySelector("#username").classList.remove("nightBox");
    document.querySelector("#password").classList.remove("nightBox");
    document.querySelector("#confirmPsw").classList.remove("nightBox");
    document.querySelector("#email").classList.remove("nightBox");


}



let theme = localStorage.getItem("theme");
if (theme === "dark"){
    dark();
}else {
    light()
}

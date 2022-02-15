/**
 * Pridava elementum classy pro zapnuti Dark mode.
 */
function dark(){
    document.body.classList.add("nightBody");
    document.querySelector(".box").classList.add("nightBox");

}

/**
 * Odebira elementum classy pro vypnuti Dark mode.
 */
function light(){
    document.body.classList.remove("nightBody");
    document.querySelector(".box").classList.remove("nightBox");

}



/**
 * Zjisteni hodnoty v localStorage
 * @type {string}
 */
let theme = localStorage.getItem("theme");
if (theme === "dark"){
    dark();
}else{
    light()
}
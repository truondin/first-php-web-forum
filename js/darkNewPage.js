let checkbox = document.querySelector("#checkbox");

checkbox.addEventListener("click", change);

/**
 * Pridava elementum classy pro zapnuti Dark mode.
 */
function dark(){
    document.querySelector(".main").classList.add("nightMain");
    document.querySelector("#h1").classList.add("nightMain");
    document.body.classList.add("nightMain");
    document.querySelector(".footer").classList.add("night");
    document.querySelector(".header").classList.add("night");
    document.querySelector(".nav").classList.add("nightNav");
    document.querySelector(".ul").classList.add("nightNav");
    document.querySelector(".typeAnswer").classList.add("nightAnswer");


}

/**
 * Odebira elementum classy pro vypnuti Dark mode.
 */
function light(){
    document.querySelector(".main").classList.remove("nightMain");
    document.querySelector("#h1").classList.remove("nightMain");
    document.body.classList.remove("nightMain");
    document.querySelector(".footer").classList.remove("night");
    document.querySelector(".header").classList.remove("night");
    document.querySelector(".nav").classList.remove("nightNav");
    document.querySelector(".ul").classList.remove("nightNav");
    document.querySelector(".typeAnswer").classList.remove("nightAnswer");
}

/**
 *
 * Meni dark mode podle odskrtnuti checkboxu
 * @param checkbox
 * Selector pro checkbox na strance
 *
 */
function change(checkbox){
    if (checkbox.target.checked){
        dark()
        /* ulozeni dark modu do local storage */
        localStorage.setItem("theme", "dark");


    }else{
        light()
        /* ulozeni light modu do local storage */
        localStorage.setItem("theme", "light");

    }
}


/* zjisteni local storage */
let theme = localStorage.getItem("theme");
/* if theme je dark, tak premenim na dark mode */
if (theme === "dark"){
    dark();
    checkbox.checked = true;
}else{
    light()
}
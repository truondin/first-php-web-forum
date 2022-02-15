/**
 * Zjistuje zda je titulek spravne vyplnen.
 * @returns {boolean}
 * Vraci false, kdyz je titulek nespravne vyplnen. Jinak true.
 */
function emptyHeadline() {
    let headline = document.querySelector(".headline")
    if (headline.value.length < 1){
        headline.classList.add("error");
        return false;
    }
    else {
        headline.classList.remove("error");
        return true;
    }
}

/**
 * Zjistuje zda je obsah textarea vyplnen.
 * @returns {boolean}
 * Vraci False, kdyz je textarea nevyplnen. Jinak true
 */
function emptyTextarea(){
    let textarea = document.querySelector(".question")
    if (textarea.value.length < 1){
        textarea.classList.add("error");
        return false;
    }
    else{
        textarea.classList.remove("error");
        return true;
    }
}

document.querySelector(".headline").addEventListener("blur", emptyHeadline);
document.querySelector(".question").addEventListener("blur", emptyTextarea);


/**
 * Zabranuje defaultnimu odeslani, v pripade spatneho vyplneni formulare.
 * @param event
 * parametr eventu na kterym funkce funguje
 */
function kontrola(event){
    if (!emptyTextarea()){
        event.preventDefault();
    }
    else if (!emptyHeadline()){
        event.preventDefault();
    }
}

document.querySelector(".form").addEventListener("submit", kontrola)
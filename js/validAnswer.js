/**
 * Zjistuje zda je input prazdny
 * @returns {boolean}
 * Vraci true pokud input neni prazdny. Jinak vraci false
 */
function emptyInput() {
    let answer = document.querySelector(".typeAnswer")
    if (answer.value.length < 1){
        answer.classList.add("error");
        return false;
    }
    else {
        answer.classList.remove("error");
        return true;
    }
}

/**
 * Zabranuje defaultnimu odeslani, v pripade spatneho vyplneni formulare
 * @param event
 * parametr eventu na kterym funkce funguje.
 */
function kontrola(event){
    if (!emptyInput()){
        event.preventDefault();
    }
}

document.querySelector(".typeAnswer").addEventListener("blur", emptyInput);
document.querySelector(".form").addEventListener("submit", kontrola)
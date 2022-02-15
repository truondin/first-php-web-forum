/**
 * Zjistuje zda je username spravne vyplnen.
 * @returns {boolean}
 * Vraci false v pripade nespravneho vyplneni. Jinak true.
 */
function prazdnyUser() {
    let user = document.querySelector("#username");
    if (user.value.length < 1) {
        user.classList.add("error");

        return false
    }
    if (hasBadChar(user.value)){
        user.classList.add("error");
        return false
    }
    else {
        user.classList.remove(("error"))
        return true

    }
}

/**
 *
 * @param check
 * parametr check, ktery je kontrolovan zda neobsahuje zakazane znaky
 * @returns {boolean}
 * Vraci true nebo false podle toho zda check obsahuje zakazany znak
 */
function hasBadChar(check){
    let badChars = ["<", ">", "?", '"',"|", "/", '"']
    for (i = 0; i < badChars.length; i++){
        if (check.includes(badChars[i])){
            return true;
        }
    }
    return false;
}

/**
 * Zjistuje zda bylo pole hesla spravne vyplnene.
 * @returns {boolean}
 * Vraci false v pripade nespravneho vyplneni. Jinak true.
 */
function validHeslo(){
    let heslo = document.querySelector("#password");

    if (heslo.value.length < 7) {
        heslo.classList.add("error");
        return false
    }
    else if(heslo.value.search(/[0-9]/) === -1){
        heslo.classList.add("error");
        return false
    }
    else if(heslo.value.search(/[a-z]/) === -1){
        heslo.classList.add("error");
        return false
    }
    else if(heslo.value.search(/[A-Z]/) === -1) {
        heslo.classList.add("error");
        return false
    }
    else {
        heslo.classList.remove("error");
        return true

    }
}

/**
 * Zjistuje zda bylo pole email vyplneno spravne a zda je email validni.
 * @returns {boolean}
 * Vraci false v pripade nespravneho vyplneni. Jinak true.
 */
function validEmail(){
    let email = document.querySelector("#email");

    let pattern = /^([a-zA-Z0-9.-])+@([a-zA-Z0-9-])+\.([a-z]{2,3})$/;

    if(pattern.test(email.value)){
        console.log("valid")
        email.classList.remove("error");
        return true;
    }

    else {
        email.classList.add("error");
        console.log("nevalidni")
        return false;
    }

}

/**
 * Zjistuje zda je kontrolni heslo spravne vyplnene a zda se shoduje s heslem.
 * @returns {boolean}
 * Vraci false v pripade nespravneho vyplneni. Jinak true.
 */
function validConfirm(){
    let confirmPsw = document.querySelector("#confirmPsw");
    let heslo = document.querySelector("#password");
    if (confirmPsw.value.length < 1) {
        confirmPsw.classList.add("error");
        return false
    }else if (confirmPsw.value !== heslo.value){
        confirmPsw.classList.add("error");
        return false
    }
    else {
        confirmPsw.classList.remove(("error"))
        return true

    }
}

document.querySelector("#username").addEventListener('blur', prazdnyUser);
document.querySelector("#email").addEventListener('blur', validEmail);
document.querySelector("#password").addEventListener('blur', validHeslo);
document.querySelector("#confirmPsw").addEventListener('blur', validConfirm);

/**
 * Kontroluje zda byly pole formulare vyplneny spravne. Zabranuje odeslani formulare v pripade spatneho vyplneni a upozornuje na chybu klienta.
 * @param e
 * parametr eventu na kteryem funkce pracuje
 */
function validForm(e){
    if (!prazdnyUser()){
        e.preventDefault();
        alert("Příhlašovací jméno není správně!")
    }
    else if(!validHeslo()){
        e.preventDefault();
        alert("Heslo není správně!")
    }
    else if(!validConfirm()){
        e.preventDefault();
        alert("Hesla nejsou stejná!")
    }
    else if(!validEmail()){
        e.preventDefault();
        alert("Email není správně!")
    }
}

document.querySelector(".box").addEventListener("submit", validForm);
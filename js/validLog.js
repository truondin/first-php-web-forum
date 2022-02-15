/**
 * Kontroluje zda byl prihlasovaci email uzivatele zadan spravne
 * @returns {boolean}
 * Vraci false v pripade ze zadany email neni validni. Jinak vraci true.
 */
function prazdnyUser() {
    let user = document.querySelector("#user");

    let pattern = /^([a-zA-Z0-9.-]+)+@([a-zA-Z0-9-])+\.([a-z]{2,3})$/;

    if(pattern.test(user.value)){
        console.log("valid")
        user.classList.remove("error");
        return true;
    }

    else {
        user.classList.add("error");
        console.log("nevalidni")
        return false;
    }

}

/**
 * Kontroluje zda bylo heslo vyplnene spravne
 * @returns {boolean}
 * Vraci flase v pripade, ze heslo nebylo vyplneno spravne. Jinak vraci true.
 */
function validHeslo(){
    let heslo = document.querySelector("#password");
    if (heslo.value.length < 1) {
        heslo.classList.add("error");

        return false
    } else {
        heslo.classList.remove(("error"))
        return true

    }
}

document.querySelector("#user").addEventListener('blur', prazdnyUser);
document.querySelector("#password").addEventListener('blur', validHeslo);

/**
 * Kontroluje zda byly pole formulare vyplneny spravne. Zabranuje odeslani formulare v pripade spatneho vyplneni a upozornuje na chybu klienta.
 * @param e
 * parametr eventu na kteryem funkce pracuje
 */
function kontrolaForm(e){
    if (!prazdnyUser()){
        e.preventDefault();
        alert("Email není správně!")
    }
    else if(!validHeslo()){
        e.preventDefault();
        alert("Heslo není správně!")
    }

}
document.querySelector(".box").addEventListener("submit",kontrolaForm);

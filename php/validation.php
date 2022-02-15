<?php
/**
 * Funkce kontroluje jestli $check neobsahuje zakazane znaky (<, >, ?, ",|, /, ').
 *
 * @param $check
 * parametr check ktery je kontrolovan zda neobsahuje zakazane znaky
 * @return bool
 * Vraci true nebo false podle toho zda $check obsahuje zakazany znak
 */
function hasBadChars($check){
    $pattern = array("<", ">", "?", '"',"|", "/", "'");
    foreach ($pattern as $char){
        if (strpos($check, $char)){
            return true;
        }
    return false;
    }
}

/**
 * Funkce kontroluje spravnost zadanéo přihlašovacího jména.
 *
 * @param $username
 * Uzivatelske jmeno
 * @return string|null
 * Vraci chybovou hlasku v pripade ze $username je prazdny. Jinak nevraci nic.
 */
function kontrolaUser($username){
    if (hasBadChars($username)){
        return "Přihlašovací jméno není validní!";
    }
    if (empty($username)){
        return "Přihlašovací jméno není vyplněné!";
    }
    return null;
}

/**
 * Funkce kontroluje správnost zadání hesla pro registraci.
 *
 * @param $password
 * Heslo uzivatele
 * @return string|null
 * Vraci chybovou hlasku v pripade nesrovnalosti s pravidly hesla. Pri spravnem zadani hesla nevraci nic.
 */
function kontrolaPsw($password){
    if (empty($password)){
        return "Heslo není vyplněno!";
    }
    else if (strlen(utf8_decode($password)) < 7){
        return "Heslo neobsahuje 7 znaků!";

    }
    else if (!preg_match('@[0-9]@', $password)){
        return "Heslo neobsahuje číslici!";

    }
    else if (!preg_match('@[A-Z]@', $password)){
        return "Heslo neobsahuje velké písmeno!";

    }
    else if (!preg_match('@[a-z]@', $password)){
        return "Heslo neobsahuje malé písmeno!";
    }
    else{
        return null;
    }
}

/**
 * Funkce kontroluje správnost zadaného emailu při registraci.
 *
 * @param $email
 * Email uzivatele
 * @return string|null
 * Vraci chybovou hlasku v pripade nevalidniho emailu. Pri spravnem zadani emailu nevraci nic.
 */
function kontrolaEmail($email){
    if (empty($email)){
        return "Email není vyplněn!";
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return "Email není validní!";
    }
    else{
        return null;
    }
}

/**
 * Funkce kontroluje správnost zadaného kontrolního hesla při registraci.
 *
 * @param $confirmPsw
 * Kontrolni heslo
 * @param $password
 * Heslo uzivatele
 * @return string|null
 * Vraci chybovou hlasku v pripade ze se hesla neshoduji. Jinak nevraci nic.
 */
function kontrolaConfirm($confirmPsw, $password){
    if (empty($confirmPsw)){
        return "Potvrzení hesla není vyplněné!";
    }
    else if($confirmPsw !== $password){
        return "Hesla se neshodují!";
    }
    else{
        return null;
    }
}

/**
 * Funkce kotnroluje správnost zadaného hesla při přihlašování.
 *
 * @param $password
 * Uzivateslske heslo pri prihlasovani.
 * @return string|null
 * Vraci chybovou hlasku v pripade nevyplneni ple pro heslo. Jinak nevraci nic.
 */
function kontrolaLogPsw($password){
    if (empty($password)){
        return "Heslo není vyplněno!";
    }
    return null;
}
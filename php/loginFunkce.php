<?php
include_once "validation.php";

/**
 *
 * Funkce registruje nového uživatele (vytváří nový objekt User).
 *
 * @param $username
 * Uzivatelske jmeno noveho uzivatele
 * @param $email
 * Email noveho uzivatele
 * @param $password
 * Heslo noveho uzivatele
 * @param $confirmPsw
 * Zopakovane heslo noveho uzivatele pro kontrolu
 * @return string|null
 * Vraci chybovou hlasku nebo nevraci nic, pokud registrace probehla spravne.
 */

function registerUser($username, $email, $password, $confirmPsw){

    if ($password != $confirmPsw){
        return "Hesla nejsou stejná!";
    }
    if(existingUsers($email)){
        return "Uživatel se zadaným emailem již existuje.";
    }
    if(existingUserByUsername($username)){
        return "Uživatel se zadaným přihlašovacím jménem již existuje.";
    }
    if (kontrolaEmail($email) != null || kontrolaUser($username) != null || kontrolaPsw($password) != null || kontrolaConfirm($confirmPsw, $password) != null){
        return "Některé z polí je vyplněné špatně!";
    }
    else{

        $user = new User;
        $user->username = trim(htmlspecialchars($username));
        $user->email = trim(htmlspecialchars($email));
        $user->password = password_hash(trim(htmlspecialchars($password)), PASSWORD_DEFAULT);

        $addUser = json_encode($user);

        file_put_contents("databaze/main/dbUsers.txt", $addUser.PHP_EOL, FILE_APPEND);
        createUserPage(htmlspecialchars($username));
        return null;

    }
}

/**
 * Funkce kontroluje zda je není email už využíván jiným uživatelem.
 *
 * @param $checkEmail
 * Email pro kontrolu zda je pouzivan
 * @return bool
 * Vraci True pokud je email uz vyzivan, jinak vraci False
 */
function existingUsers($checkEmail){
    $user = findUser($checkEmail);
    if ($user != null){
        return true;
    }
    else{
        return false;
    }
}

/**
 * Funkce hledá uživatele (objekt User) na základě emailu.
 *
 * @param $email
 * Email pro kontrolu zda je pouzivan
 * @return User|null
 * Vraci uzivatele (objekt) s parametrem $email, pokud byl nalezen. Jinak nevraci nic
 */
function findUser($email){
    if (!file_exists("databaze/main/dbUsers.txt")){
        $create = fopen("databaze/main/dbUsers.txt", "w");
        fclose($create);
    }
    $database = fopen("databaze/main/dbUsers.txt", "r");

    if($database){
        while (($line = fgets($database)) !== false){
            $savedUser = json_decode($line);

            if ($savedUser->email == $email){
                $user = new User;
                $user->username = $savedUser->username;
                $user->email = $savedUser->email;
                $user->password = $savedUser->password;
                return $user;

            }
        }
        fclose($database);
    }
    return null;

}

/**
 * Funkce ověřuje zda není uživatelské jméno využíváno jiným uživatelem.
 *
 * @param $checkName
 * Uzivatelske jmeno pro kontrolu zda je pouzivan
 * @return bool
 * Vraci True pokud je uzivatelske jmeno uz vyzivan, jinak vraci False
 */
function existingUserByUsername($checkName){
    $user = findUserByName($checkName);
    if ($user != null){
        return true;
    }
    else{
        return false;
    }
}

/**
 * Funkce hledá uživatele (objekt User) na základě uživatelského jména.
 *
 * @param $name
 * Uzivatelske jmeno pro kontrolu zda je pouzivan
 * @return User|null
 * Vraci uzivatele (objekt) se zadanym uzivatelskym jmenenm ($name), pokud byl nalezen. Jinak nevraci nic.
 */
function findUserByName($name){
    $database = fopen("databaze/main/dbUsers.txt", "r");

    if($database){
        while (($line = fgets($database)) !== false){
            $savedUser = json_decode($line);

            if ($savedUser->username == $name){
                $user = new User;
                $user->username = $savedUser->username;
                $user->email = $savedUser->email;
                $user->password = $savedUser->password;
                return $user;

            }
        }
        fclose($database);
    }
    return null;

}

/**
 * Funkce přihlašuje uživatele (vytváří session s uživatelským jménem).
 *
 * @return mixed|null
 * Vraci session s prihlasenym uzivatelem. Jinak nevraci nic.
 */
function logIn(){
    if (isset($_SESSION["userLogged"])){
        return $_SESSION["userLogged"];
    }
    return null;
}

/**
 * Funkce odhlašuje uživatele (zneplatňuje session s uživatelským jménem).
 *
 * Unset session se zalogovanym uzivatelem (odhlaseni)
 */
function logOut(){
    unset($_SESSION["userLogged"]);
}
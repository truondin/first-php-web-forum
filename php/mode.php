<?php
/**
 * Vola css soubor pro navbar dle nastaveneho cookie na hlavních stránkách.
 */
function mode(){
    if (isset($_COOKIE["mode"]) && $_COOKIE["mode"] == "mobil"){
        echo '<link href="css/mobil.css" rel="stylesheet">';
    }
    else if(isset($_COOKIE["mode"]) && $_COOKIE["mode"] == "web"){
        echo '<link href="css/style.css" rel="stylesheet">';
    }
}

/**
 * Nastavuje cookie dle zmacknuteho tlacitka.
 */
function modeActive(){
    if (isset($_GET["mobil"])){
        setcookie("mode", "mobil");
        $_COOKIE["mode"] = "mobil";
    }else if(isset($_GET["web"])){
        setcookie("mode", "web");
        $_COOKIE["mode"] = "web";
    }
}

/**
 * Vola css soubor pro navbar dle nastaveneho cookie na stránkách databáze.
 */
function mode2(){
    if (isset($_COOKIE["mode"]) && $_COOKIE["mode"] == "mobil"){
        echo '<link href="../css/mobil.css" rel="stylesheet">';
    }
    else if(isset($_COOKIE["mode"]) && $_COOKIE["mode"] == "web"){
        echo '<link href="../css/style.css" rel="stylesheet">';
    }
}

/**
 * Vola css soubor pro navbar dle nastaveneho cookie na stránkách uživatelů.
 */
function mode3(){
    if (isset($_COOKIE["mode"]) && $_COOKIE["mode"] == "mobil"){
        echo '<link href="../../css/mobil.css" rel="stylesheet">';
    }
    else if(isset($_COOKIE["mode"]) && $_COOKIE["mode"] == "web"){
        echo '<link href="../../css/style.css" rel="stylesheet">';
    }
}

/**
 * Vola css soubor pro navbar dle nastaveneho cookie na stránce pro editaci diskuze.
 */
function mode4(){
    if (isset($_COOKIE["mode"]) && $_COOKIE["mode"] == "mobil"){
        echo '<link href="../../../css/mobil.css" rel="stylesheet">';
    }
    else if(isset($_COOKIE["mode"]) && $_COOKIE["mode"] == "web"){
        echo '<link href="../../../css/style.css" rel="stylesheet">';
    }
}

/**
 * Vybira javascript pro dark mode podle toho, zda je uzivatel prihlasen nebo ne.
 *
 * @param $loggedUser
 * Parametr pro zalogovaneho uzivatele.
 */
function darkModeForNewPage($loggedUser){
    if ($loggedUser == null){
        echo '<script src="../js/day-nightMode.js"></script>';
    }else{
        echo '<script src="../js/darkNewPage.js"></script>';
    }
}

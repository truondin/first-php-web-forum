<?php
    include_once "php/mode.php";
    include_once "php/funkceDiskuze.php";
    include_once "php/loginFunkce.php";

    session_start();
    $loggedUser = logIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informace</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="fontsawesome/css/all.css" rel="stylesheet"> <!-- icons from Font Awesome -->
    <?php
    mode();
    ?>
</head>
<body>

<header class="header">

    <h1>
        <a href="index.php"><span class="zav">{ </span>WEBOVKY<span class="zav"> }</span></a>
    </h1>

    <?php loginOrName($loggedUser); ?>
<!--    <a href="Login.php" class="login"><p><i class="fas fa-user"></i> LOGIN</p></a>-->


</header>
<main class="container">

    <nav class="nav">

        <h3>
            <i class="fas fa-bars"></i> MENU:
        </h3>

        <ul class="ul">
            <li><a href="index.php"><i class="fas fa-home"></i> Domov</a></li>
            <li><a class="active" href="Info.php"><i class="fas fa-info"></i> Info</a></li>
            <li><a href="Diskuze.php"><i class="fas fa-users"></i> Diskuze</a></li>
            <li><a href="nastaveni.php"><i class="fas fa-cog"></i> Nastavení</a></li>
        </ul>
        <label for="checkbox">
            <input type="checkbox" class="toggle" id="checkbox">
            <span class="checkbtn">
                <i class="fas fa-sun" id="sun"></i>
                <i class="fas fa-moon" id="moon"></i>

            </span>
        </label>

    </nav>

    <div class="main">
        <h1 id="h1">Jak používat forum!</h1>
    <div class="info">
        <h3>Nový člen:</h3>
        <p>Pokud jsi zde nově, máš 2 možnosti.</p>
        <p>Buď se<strong> nepříhlášeně </strong>pouze dívat na diskuze a popřípadě si najít řešení na svůj problém. </p>
        <p>A nebo se <strong>zaregistrovat se</strong>, popřípadě <strong>se přihlásit</strong> k již vytvořenému účtu, díky čemuž se můžeš rovnou zeptat na svůj problém či rovnou odepsat jinému uživateli.</p>

        <h3>Orientace:</h3>
        <ul>
            <li>Vpravo nahoře můžeš vidět <strong>přihlašovací tlačítko</strong>, které tě zavede k přihlášení/vytvroření nového účtu.</li>
            <li>Vlevo po straně, popřípadě pod hlavičkou (na menších obrazovkách), můžeš nalézt <strong>menu</strong>, které tě zaveda tam kam chceš!</li>
            <li>Vlevo dole (u menších obrazovek vlevo od menu) najdeš tlačítko na přepnutí mezi <strong>light/dark modem</strong>, které si můžeš vybrat dle svých preferencí.</li>
            <li>V nastavení najdete 2 tlačítka, se kterými si můžete změnít "look" webovky (mobilní verze / webová verze) v případě kdybyste chtěli mobilní rozložení i na větších obrazovkách! :)</li>
            <li>Po příhlášení se místo přihlašovacího tlačítka objeví tlačítko vašeho profilu, odkud se můžete take odhlásit.</li>
            <li>Na stránce vašeho profilu, pak budou zobrazeny vaše diskuze, které budete moci editovat, či rovnou odstranit.</li>
        </ul>

        <h3>Pravidla:</h3>
        <ol>
            <li>Neurážet ostatní uživatele.</li>
            <li>Chovat se slušně (nepsát vulgární slova v diskuzích, atd.).</li>
            <li>Vytvářet diskuze pouze ohledně problémů s webovými aplikacemi.</li>
            <li><strong>Vytvářet diskuze</strong> či <strong>odpovídat na diskuzi</strong> mohou pouze přihlášení uživatelé.</li>
        </ol>

    </div>

    </div>

</main>

<footer class="footer">
    &copy; 2020 Dinh Dinh Truong
</footer>
<script src="js/day-nightMode.js"></script>
</body>
</html>

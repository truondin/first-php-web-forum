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
    <title>HomePage</title>
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
            <li><a class="active" href="index.php"><i class="fas fa-home"></i> Domov</a></li>
            <li><a href="Info.php"><i class="fas fa-info"></i> Info</a></li>
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
        <h1 id="h1">VÍTEJTE NA DISKUZNÍM FORU <span class="zav">{ </span>WEBOVKY<span class="zav"> }</span>!</h1>
        <h3>Tato stránka vznikla za účelem pomoci všem webovým developerům, kteří potřebují pomoct s kódem.</h3>
        <p>Webovky je otevřené komunitní diskuzní forum primárně určené pro amatérské webové programátory, kteří hledají pomoct se svým kódem.</p>
        <p>Své místo si zde najdou i více zkušení jedinci, ať už chtějí pomoci jiným nebo sami hledají pomoc.</p>
        <p><strong>Pokud se chceš dozvědět více o tom jak forum funguje, podívej se do sekce <a href="Info.php" class="mainInfo">Info!</a></strong></p>



    </div>

</main>

<footer class="footer">
    &copy; 2020 Dinh Dinh Truong
</footer>
<script src="js/day-nightMode.js"></script>
</body>
</html>
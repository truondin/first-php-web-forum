<?php
    include_once "php/mode.php";
    include_once "php/funkceDiskuze.php";
    include_once "php/loginFunkce.php";

    session_start();
    $loggedUser = logIn();

    modeActive();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nastavení</title>
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
            <li><a href="Info.php"><i class="fas fa-info"></i> Info</a></li>
            <li><a href="Diskuze.php"><i class="fas fa-users"></i> Diskuze</a></li>
            <li><a class="active" href="nastaveni.php"><i class="fas fa-cog"></i> Nastavení</a></li>
        </ul>

        <form action="index.php" method="post">
            <label for="checkbox">
                <input type="checkbox" class="toggle" id="checkbox" name="checkbox">
                <span class="checkbtn">
                    <i class="fas fa-sun" id="sun"></i>
                    <i class="fas fa-moon" id="moon"></i>

                </span>
            </label>
            <input type="submit">
        </form>
    </nav>

    <div class="main">
        <h1 id="h1"><i class="fas fa-cog"></i> NASTAVENÍ</h1>
        <div class="info">
        <form action="nastaveni.php" method="get">
            <h3>Pro mobilní verzi klikněte:</h3>
            <button type="submit" name="mobil" value="mobil" class="webLook">Mobilní verze</button><br>
            <h3>Pro webovou verzi klikněte:</h3>
            <button type="submit" name="web" value="web" class="webLook">Webová verze</button>
        </form>
        </div>

    </div>

</main>

<footer class="footer">
    &copy;2020 Dinh Dinh Truong
</footer>
<script src="js/day-nightMode.js"></script>
</body>
</html>

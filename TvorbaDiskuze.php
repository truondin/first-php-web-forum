<?php
    include_once "php/mode.php";
    include_once "php/funkceDiskuze.php";
    include_once "php/loginFunkce.php";

    $headline = null;
    $textarea = null;
    $emptySpace = null;

    session_start();
    $loggedUser = logIn();
    if ($loggedUser == null){
        header("location:Login.php");
        die();
    }
    else {
        if (isset($_POST["submit"])) {
            $headline = $_POST["headline"];
            $textarea = $_POST["textarea"];

            if (checkCsrfToken($_POST["token"]) === false){
                http_response_code(500);
                die("invalid CSRF token!");
            }
            else {
                $emptySpace = addDiscuss($headline, $textarea, $loggedUser->username);
            }
        }
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tvorba Diskuze</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/php.css" rel="stylesheet">
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


</header>
<main class="container">

    <nav class="nav">

        <h3>
            <i class="fas fa-bars"></i> MENU:
        </h3>

        <ul class="ul">
            <li><a href="index.php"><i class="fas fa-home"></i> Domov</a></li>
            <li><a href="Info.php"><i class="fas fa-info"></i> Info</a></li>
            <li><a class="active" href="Diskuze.php"><i class="fas fa-users"></i> Diskuze</a></li>
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
        <h1 id="h1">VYTVOŘIT NOVOU DISKUZI:</h1>
        <div class="create">
            <form class="form" action="TvorbaDiskuze.php" method="post">
                <label class="headlineLabel">
                    Titulek:<br>
                    <input type="text" class="headline" name="headline" value="<?php echo htmlspecialchars($headline);?>" >
                </label><br>
                <label class="questionLabel">
                    Otázka:<br>
                    <textarea class="question" name="textarea" ><?php echo htmlspecialchars($textarea);?></textarea>
                </label><br>
                <input type="hidden" name="token" value="<?php echo addCsrfToken(); ?>">
                <button type="submit" class="submitDiscuss" name="submit">
                    Odeslat
                </button>
                <span class="errorPHP"><?php echo $emptySpace;?></span>
            </form>

        </div>




    </div>

</main>

<footer class="footer">
    &copy; 2020 Dinh Dinh Truong
</footer>
<script src="js/day-nightMode3.js"></script>
<script src="js/validDiskuze.js"></script>
</body>
</html>

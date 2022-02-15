<?php
include_once "../../php/mode.php";
include_once "../../php/funkceDiskuze.php";
include_once "../../php/loginFunkce.php";
include_once "../../php/deleteOrEdit.php";

session_start();
$loggedUser = logIn();

if ($loggedUser == null){
    header("location:../../Login.php");
    die();
}
if(isset($_POST["logout"])) {
    if ($loggedUser == null) {
        header("location:#");
    } else {
        logOut();
        header("location:../../index.php");
    }
}

$diskuze = loadMyDiscussion($loggedUser->username);
if (isset($_POST["delete"])){
    foreach ($diskuze as $delTema){
        if ($delTema->page === $_POST["page"]){
            deleteDiscussion($delTema);
            header("location: $delTema->autor.php");

        }
    }
}
if (isset($_POST["edit"])){
    ob_start();
    header("location: edit/editDiskuze.php");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dindula</title>
    <link href="../../css/style.css" rel="stylesheet">
    <link href="../../css/php.css" rel="stylesheet">
    <link href="css/user.css" rel="stylesheet">
    <link href="../../fontsawesome/css/all.css" rel="stylesheet"> <!-- icons from Font Awesome -->
    <?php
    mode3();
    ?>
</head>
<body>

<header class="header">

    <h1>
        <a href="../../index.php"><span class="zav">{ </span>WEBOVKY<span class="zav"> }</span></a>
    </h1>
    
    <a href="Dindula.php"><div class="userPage"><p><i class="fas fa-user"></i> <?php echo $loggedUser->username; ?></p></div></a>

    <form method="post" action="#">
        <button type="submit" name="logout" class="loggout">Odhlásit se</button>
    </form>


</header>
<main class="container"> 

    <nav class="nav">

        <h3>
            <i class="fas fa-bars"></i> MENU:
        </h3>

        <ul class="ul">
            <li><a href="../../index.php"><i class="fas fa-home"></i> Domov</a></li>
            <li><a href="../../Info.php"><i class="fas fa-info"></i> Info</a></li>
            <li><a href="../../Diskuze.php"><i class="fas fa-users"></i> Diskuze</a></li>
            <li><a href="../../nastaveni.php"><i class="fas fa-cog"></i> Nastavení</a></li>
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
        <h1 id="h1"><i class="far fa-address-card"></i> Dindula</h1>

        <h2><i class="fas fa-folder"></i> Moje dotazy:</h2>

        <?php
        if (count($diskuze) == 0){
                echo "<strong>Zatím si nevytvořil žádnou diskuzi :(</strong>";
            }
        
        echoMyDiscussion($diskuze, $loggedUser, $loggedUser->username);
        ?>



    </div>

    



</main>

<footer class="footer">
    &copy; 2020 Dinh Dinh Truong
</footer>
<script src="../../js/day-nightMode.js"></script>
</body>
</html>
<?php
include_once "../php/mode.php";
include_once "../php/funkceDiskuze.php";
include_once "../php/pagination.php";
include_once "../php/deleteOrEdit.php";
include_once "../php/loginFunkce.php";

$admin = "Dindula";
session_start();
$loggedUser = logIn();
$emptyInput = null;
$diskuze = loadToFindDiscussion();
$answers = createDbAnswer("4aa08153758178b3");

$onPageAnswers = 5;
$countAnswers = count($answers);
$numOfAnswers = ceil($countAnswers / $onPageAnswers);

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page > $numOfAnswers){
        $page = 1;
    }
} else {
    $page = 1;
}

$firstAnswer = ($page - 1) * $onPageAnswers;
$revAnswers = array_reverse($answers);
$db = array_slice($revAnswers, $firstAnswer, $onPageAnswers);


if(isset($_POST["send"])){

    $answer = $_POST["answer"];
    if (checkCsrfToken($_POST["token"]) === false){
        header("location: #");
        }
    else {
    $emptyInput = addAnswer("4aa08153758178b3", $answer,$loggedUser->username);
    header("location:4aa08153758178b3.php");
    }
}

if (isset($_POST["delete"])){
    foreach ($answers as $delAns){
        if ($delAns->id === $_POST["id"]){
            deleteAnswer($delAns, "4aa08153758178b3");
            header("location:4aa08153758178b3.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Téma</title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/php.css" rel="stylesheet">
    <link href="../fontsawesome/css/all.css" rel="stylesheet"> <!-- icons from Font Awesome -->
    <?php
    mode2();
    ?>
</head>
<body>

<header class="header">

    <h1>
        <a href="../index.php"><span class="zav">{ </span>WEBOVKY<span class="zav"> }</span></a>
    </h1>
    
    <?php loginOrNameForDb($loggedUser); ?>



</header>
<main class="container"> 

    <nav class="nav">

        <h3>
            <i class="fas fa-bars"></i> MENU:
        </h3>

        <ul class="ul">
            <li><a href="../index.php"><i class="fas fa-home"></i> Domov</a></li>
            <li><a href="../Info.php"><i class="fas fa-info"></i> Info</a></li>
            <li><a class="active" href="../Diskuze.php"><i class="fas fa-users"></i> Diskuze</a></li>
            <li><a href="../nastaveni.php"><i class="fas fa-cog"></i> Nastavení</a></li>
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
        <?php
        echoDiscussion($diskuze,"4aa08153758178b3");
        ?>
        
        <div class="allAnswers">
        <h3>
            ODPOVĚDI:
            <?php
            if (count($answers) == 0){
                echo null;
            }else{
            changePage($page, $numOfAnswers,"4aa08153758178b3" );
            }
            ?>
        </h3>

        <div class="answer">
            <?php
            if (count($answers) == 0){
                echo "<h4>Na tuto otázku zatím nikdo neodpověděl.</h4>";
            }else{
                if ($loggedUser == null){
                    loadAnswersIfNotLogged($db);
                }
                else {
                    loadAnswers($db, $loggedUser->username, $admin);
                }
          
            }
            
            canAnswer($loggedUser);
            ?>



            </div>
        </div>

    </div>

    



</main>

<footer class="footer">
    &copy; 2020 Dinh Dinh Truong
</footer>
<?php darkModeForNewPage($loggedUser); ?>
<script src="../js/validAnswer.js"></script>
</body>
</html>
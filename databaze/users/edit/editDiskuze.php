<?php
include_once "../../../php/mode.php";
include_once "../../../php/funkceDiskuze.php";
include_once "../../../php/deleteOrEdit.php";
include_once "../../../php/loginFunkce.php";


$headline = null;
$textarea = null;
$page = null;
$emptySpace = null;
$editHeadline = $_POST["headline"];
$editTextarea = $_POST["textarea"];


session_start();
$loggedUser = logIn();



if ($loggedUser == null){
    header("location:../../../Login.php");
    die();
}
else {
    if (isset($_POST["submit"])) {
        $headline = $_POST["headlineEdit"];
        $textarea = $_POST["textareaEdit"];
        $page = $_POST["pageEdit"];

        if (checkCsrfToken($_POST["token"]) === false){
            http_response_code(500);
            die("invalid CSRF token!");
        }
        if (empty($headline) || empty($textarea)){
            $emptySpace = "Některé z polí bylo odeslané prázdné!";
        }
        else {
        editDiscussion($page, $headline, $textarea, $loggedUser->username);
        header("location: ../../$page.php");
        }
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editace Diskuze</title>
    <link href="../../../css/style.css" rel="stylesheet">
    <link href="../../../css/php.css" rel="stylesheet">
    <link href="../css/user.css" rel="stylesheet">
    <link href="../../../fontsawesome/css/all.css" rel="stylesheet"> <!-- icons from Font Awesome -->
    <?php
    mode4();
    ?>
</head>
<body>

<header class="header">

    <h1>
        <a href="../../../index.php"><span class="zav">{ </span>WEBOVKY<span class="zav"> }</span></a>
    </h1>

    <a href="../<?php echo $loggedUser->username; ?>.php"><div class="userPage"><p><i class="fas fa-user"></i> <?php echo $loggedUser->username; ?></p></div></a>


</header>
<main class="container">

    <nav class="nav">

        <h3>
            <i class="fas fa-bars"></i> MENU:
        </h3>

        <ul class="ul">
            <li><a href="../../../index.php"><i class="fas fa-home"></i> Domov</a></li>
            <li><a href="../../../Info.php"><i class="fas fa-info"></i> Info</a></li>
            <li><a href="../../../Diskuze.php"><i class="fas fa-users"></i> Diskuze</a></li>
            <li><a href="../../../nastaveni.php"><i class="fas fa-cog"></i> Nastavení</a></li>
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
        <h1 id="h1">EDITACE DISKUZE: </h1>
        <div class="create">
            <form class="form" action="editDiskuze.php" method="post">
                <input type="hidden" name="headline" value="<?php echo htmlspecialchars($_POST["headline"]) ?>">
                <input type="hidden" name="textarea" value="<?php echo htmlspecialchars($_POST["textarea"]) ?>">
                <label class="headlineLabel">
                    Titulek:<br>
                    <input type="text" class="headline" name="headlineEdit" value="<?php echo htmlspecialchars($editHeadline) ?>" required="required">
                </label><br>
                <label class="questionLabel">
                    Otázka:<br>
                    <textarea class="question" name="textareaEdit" required="required" ><?php echo htmlspecialchars($editTextarea);?></textarea>
                </label><br>
                <input type="hidden" name="token" value="<?php echo addCsrfToken(); ?>">
                <input type="hidden" name="pageEdit" value="<?php echo $_POST["page"] ?>">
                <button type="submit" class="submitDiscuss" name="submit">
                    Uložit
                </button>
                <span class="errorPHP"><?php echo $emptySpace;?></span>
            </form>

        </div>




    </div>

</main>

<footer class="footer">
    &copy; 2020 Dinh Dinh Truong
</footer>
<script src="../../../js/day-nightMode3.js"></script>
<script src="../../../js/validDiskuze.js"></script>
</body>
</html>
<?php
include_once "php/validation.php";
include_once "php/funkceDiskuze.php";
include_once "php/loginFunkce.php";
session_start();

$username = null;
$email = null;
$password = null;
$confirmPsw = null;
$resultRegistration = null;
$errorUser = null;
$errorEmail = null;
$errorPsw = null;
$errorConfirm = null;

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["psw"];
    $confirmPsw = $_POST["confirmPsw"];

    $resultRegistration = registerUser($username, $email, $password, $confirmPsw);
    if ($resultRegistration == null){
        if (checkLoginToken($_POST["token"]) === false) {
            http_response_code(500);
            die("invalid CSRF token!");
        }
        else {
            header("location: thx.php");
        }
    }

    if (isset($username)){
        kontrolaUser($username);
        $errorUser = kontrolaUser($username);

    }
    if (isset($email)){
        kontrolaEmail($email);
        $errorEmail = kontrolaEmail($email);
    }
    if (isset($password)){
        kontrolaPsw($password);
        $errorPsw = kontrolaPsw($password);
    }
    if (isset($confirmPsw)){
        kontrolaConfirm($confirmPsw, $password);
        $errorConfirm = kontrolaConfirm($confirmPsw, $password);
    }


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrace</title>
    <link href="css/log.css" rel="stylesheet">
    <link href="fontsawesome/css/all.css" rel="stylesheet"> <!-- icons from Font Awesome -->
    <link href="css/php.css" rel="stylesheet">

</head>
<body>
<header class="header">

    <a href="Login.php" class="nextLog">Přihlásit <i class="fas fa-sign-in-alt"></i></a>
    <a href="index.php" class="home"><i class="fas fa-2x fa-home"></i></a>

</header>
<main class="logBox">
    <form class="box" action="Register.php" method="post">
        <h1>
            <a href="index.php"><span class="zav">{ </span>WEBOVKY<span class="zav"> }</span></a>
        </h1>
        <h2><i class="fas fa-house-user"></i> ZAREGISTROVAT SE:</h2>
        <label class="usernameTip">
            <input type="text" placeholder="Přihlašovací jméno" name="username" class="input" id="username" value="<?php echo htmlspecialchars($username);?>"
                   required="required" >
            <span class="tip" >
                Přihlašovací jméno uživatele.<br>
                Jméno nejsmí obsahovat:<br>
                <strong><, >, ?, ", ', |, /</strong> <br>
                <span class="errorPHP"><?php echo $errorUser; ?></span>
            </span>
        </label>


        <label class="emailTip">
            <input type="email" placeholder="Vložte email" name="email" class="input" id="email" value="<?php echo htmlspecialchars($email);?>" required="required">
            <span class="tip" >
                Např. example@gmail.com <br>
                <span class="errorPHP"><?php echo $errorEmail; ?></span>
            </span>
        </label>

        <label class="passwordTip">
            <input type="password" placeholder="Heslo" name="psw" class="input" id="password" value="<?php echo htmlspecialchars($password);?>" required="required"
                   pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{7,}">
            <span class="tip" >
                Heslo musí mít : <br>
                minimálně 7 znaků <br>
                alespoň 1 číslici <br>
                alespoň 1 velké písmeno <br>
                alespoň 1 malé písmeno <br>
                <span class="errorPHP"><?php echo $errorPsw; ?></span>

            </span>
        </label>

        <label class="confirmTip">
            <input type="password" placeholder="Potvrdit heslo" name="confirmPsw" class="input" id="confirmPsw" value="<?php echo htmlspecialchars($confirmPsw);?>" required="required">
            <span class="tip" >
                Hesla musí být stejná.<br>
                <span class="errorPHP"><?php echo $errorConfirm; ?></span>
            </span>
        </label>
        <input type="hidden" name="token" value="<?php echo addLoginToken(); ?>">
        <label><button type="submit" class="submit" name="submit">Vytvořit účet</button></label>
        <span class="errorPHP"><?php echo $resultRegistration;?></span>
    </form>
</main>

<script src="js/validRegister.js"></script>
<script src="js/day-nightRegister.js"></script>
</body>

</html>

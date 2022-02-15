<?php
include_once "php/validation.php";
include_once  "php/funkceDiskuze.php";
include_once "php/loginFunkce.php";
session_start();

$email = null;
$password = null;
$errorUser= null;
$error = null;
$overallError = null;


if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["psw"];

    $user = findUser($email);
    if ($user != null && password_verify($password, $user->password)){
        if (checkLoginToken($_POST["token"]) === false) {
            http_response_code(500);
            die("invalid CSRF token!");
        }
        else {

            $_SESSION["userLogged"] = $user;
            header("location: Diskuze.php");
        }
    }
    else {

        if ($user == null) {
            $overallError = "Uživatel se zadaným EMAILEM neexistuje.";
        } else if (empty($password) || empty($email)) {
            $overallError = "HESLO nebo EMAIL je prazdné";
        } else if (!password_verify($password, $user->password)) {
            $overallError = "Nesprávně zadané HESLO uživatele.";
        }

        if (isset($email)) {
            $errorUser = kontrolaEmail($email);

        }
        if (isset($password)) {
            $error = kontrolaLogPsw($password);

        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="css/log.css" rel="stylesheet">
    <link href="fontsawesome/css/all.css" rel="stylesheet"> <!-- icons from Font Awesome -->
    <link href="css/php.css" rel="stylesheet">

</head>

<body>
<header class="header">

    <a href="Register.php" class="nextLog">Nový účet <i class="fas fa-house-user"></i></a>
    <a href="index.php" class="home"><i class="fas fa-2x fa-home"></i></a>

</header>
<main class="logBox">
    <form class="box" action="Login.php" method="post">
        <h1>
            <a href="index.php"><span class="zav">{ </span>WEBOVKY<span class="zav"> }</span></a>
        </h1>
        <h2><i class="fas fa-sign-in-alt"></i> PŘIHLÁSIT SE:</h2>

        <label class="userTip">
            <input type="email" placeholder="Email" name="email" class="input" id="user" value="<?php echo htmlspecialchars($email);?>" required="required">
            <span class="tip" >
                Vložte přihlašovací email.<br>
                <span class="errorPHP"><?php echo $errorUser; ?></span>
            </span>
        </label>

        <label class="pswTip">
            <input type="password" placeholder="Heslo" name="psw" class="input" id="password" value="<?php echo htmlspecialchars($password);?>" required="required">
            <span class="tip" >
                Vložte vaše heslo.<br>
                <span class="errorPHP"><?php echo $error; ?></span>
            </span>
        </label>
        <input type="hidden" name="token" value="<?php echo addLoginToken(); ?>">
        <label><button type="submit" class="submit" name="submit">Login</button></label>
        <span class="errorPHP"> <?php echo $overallError ?> </span>
    </form>
</main>
<script src="js/validLog.js"></script>
<script src="js/day-nightLog.js"></script>
</body>
</html>

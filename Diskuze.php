<?php
    include_once "php/mode.php";
    include_once "php/funkceDiskuze.php";
    include_once "php/loginFunkce.php";

    session_start();
    $loggedUser = logIn();

    $diskuze = loadDiscussion();

    $diskuzeRev = array_reverse($diskuze);

    // definovani kolik bude na strance temat
    $resultsOnPage = 9;

    // zjisteni kolik je v db temat
    $countDatabase = count($diskuze);

    // definovani kolik bude celkove stranek
    $numberOfPages = ceil($countDatabase/$resultsOnPage);

    // definovani na jake strance zrovna je klient
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page > $numberOfPages){
            $page = 1;
        }
    } else {
        $page = 1;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diskuze</title>
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
        <h1 id="h1">DISKUZNÍ FORUM:</h1>
        <div class="createDiscuss">

            <a href="TvorbaDiskuze.php">Vytvořit diskuzi</a>

        </div>
        <div class="allDiskuze">

            <?php
            if (count($diskuze) == 0){
                echo "<strong>Zatím nikdo nevytvořil nějakou diskuzi :(</strong>";
            }

            // definovani jake tema diskuze bude vyvolane prvni
            $firstResult = ($page-1)*$resultsOnPage;

            // $db je cast databaze, ktera se objevi na strance
            $db = array_slice($diskuzeRev, $firstResult,  $resultsOnPage);

            //echo jednotlivych temat
                foreach ($db as $tema){
                    if ($tema !== null){
                        if (strlen($tema->headline) > 120){
                            $temaHeadline = substr($tema->headline, 0, 123)." ....";
                        }else{
                            $temaHeadline =$tema->headline;
                        }

                    echo '
                        <div class="diskuze">
                            <a href="databaze/' . $tema->page . '.php" class="open">otevřít</a><span class="topic"> <i class="far fa-comments"></i> ' . $temaHeadline . '</span> <br>                  
                        </div>
                            ';
                    }
                }

            // display STRANKOVANI
            // PREVIOUS stranka:
            echo "<div class='page'>";
            if ($page > 1) {
                echo '<a class="paging-arrow" href="Diskuze.php?page=' . ($page - 1) . '"><i class="fas fa-angle-double-left"></i></a>';
            }
            // display vsech stranek
            for ($pageNum = 1;$pageNum <= $numberOfPages; $pageNum ++) {
                if($page == $pageNum){
                    echo '<span  id="onPage">'.$pageNum.'</span>';
                }
                else {
                    echo '<a class="paging" href="Diskuze.php?page=' . $pageNum . '">' . $pageNum . '</a>';
                }
            }
            // NEXT stranka
            if (count($db) == $resultsOnPage) {
                echo '<a class="paging-arrow" href="Diskuze.php?page=' . ($page +1 ) . '"><i class="fas fa-angle-double-right"></i></a>';
            }
            echo "</div>";

            ?>
        </div>


    </div>

</main>

<footer class="footer">
    &copy; 2020 Dinh Dinh Truong
</footer>
<script src="js/day-nightMode.js"></script>
</body>
</html>

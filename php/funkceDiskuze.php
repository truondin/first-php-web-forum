<?php
include_once "diskuzeClass.php";
include_once "newPage.php";
include_once "newUser.php";

/**
 * Funkce vytváří list diskuzí z databáze diskuzí (txt soubor).
 *
 * @return array
 * Vraci list jednotlivych diskuzi z textoveho souboru pro databazi diskuzi.
 */
function loadDiscussion(){
    if (!file_exists("databaze/main/dbDiscuss.txt")){
        $create = fopen("databaze/main/dbDiscuss.txt", "w");
        fclose($create);
    }

    $allDiscuss = file_get_contents("databaze/main/dbDiscuss.txt");
    $field = explode(PHP_EOL, $allDiscuss);

    $resultDiscussion = array();
    foreach ($field as $diskuze){

        if($diskuze !== ""){
            $saveDiscuss = json_decode($diskuze);

            $discussion = new Diskuze();
            $discussion->headline = $saveDiscuss->headline;
            $discussion->textarea = $saveDiscuss->textarea;
            $discussion->page = $saveDiscuss->page;
            $discussion->autor = $saveDiscuss->autor;

            array_push($resultDiscussion, $discussion);

        }
    }

    return $resultDiscussion;
}

/**
 * Funkce přidává novou diskuzi do databáze diskuzí (txt soubor) na konec souboru.
 *
 * @param $headline
 * Parametr pro titulek nove vytvarene diskuze.
 * @param $text
 * Parametr pro text nove vytvarene diskuze.
 * @param $autor
 * Parametr oznacujici autora vytvarene diskuze.
 * @return string|null
 * Vraci chybovou hlasku v pripade prazdnych parametru, jinak nic nevraci a zapise do textoveho souboru novy objekt Diskuze a nic nevraci.
 * @throws Exception
 */
function addDiscuss($headline, $text, $autor){

    if (!empty($headline && !empty($text))){


        $random = bin2hex(random_bytes(8));

        $discussion = new Diskuze();
        $discussion->headline = trim(htmlspecialchars($headline));
        $discussion->textarea = trim(htmlspecialchars($text));
        $discussion->page = $random;
        $discussion->autor = trim(htmlspecialchars($autor));

        $textWrite = json_encode($discussion);

        file_put_contents("databaze/main/dbDiscuss.txt", $textWrite.PHP_EOL, FILE_APPEND);
        header("location:Diskuze.php");


        createPage($random, trim(htmlspecialchars($autor)));

        return null;
    }
    return "Nějaké pole není vyplněno!";


}

/**
 * Funkce vytváří list z databaze (txt soubor) odpovědí pro jednotlivou diskuzi.
 *
 * @param $databaseId
 * Id databaze pro naleznuti spravneho textoveho souboru s databazi odpovedi na diskuzi.
 * @return array
 * Vraci list jednotlivych odpovedi z textoveho souboru s databazi odpovedi na diskuzi.
 */
function createDbAnswer($databaseId){

    if (!file_exists($databaseId.'.txt')){
        $create = fopen($databaseId.'.txt', "w");
        fclose($create);
    }

    $allAnswers = file_get_contents($databaseId.'.txt');
    $fieldOfAnswers = explode(PHP_EOL, $allAnswers);

    $resultAnswer = array();
    foreach ($fieldOfAnswers as $answer){
        if ($answer !== ""){
            $saveAnswer = json_decode($answer);

            $newAnswer = new Answer();
            $newAnswer->id = $saveAnswer->id;
            $newAnswer->answer = $saveAnswer->answer;
            $newAnswer->autor = $saveAnswer->autor;

            array_push($resultAnswer, $newAnswer);
        }

    }
    return $resultAnswer;

}

/**
 * Funkce přidává novou odpověď do databáze odpovědí (txt soubor) určité diskuze.
 *
 * @param $databaseId
 * Id databaze pro naleznuti spravneho textoveho souboru s databazi odpovedi na diskuzi.
 * @param $text
 * Text odpovedi.
 * @param $autor
 * Parametr urcujici autora odpovedi.
 * @return string|null
 * Vraci chybovou hlasku v pripade prazdneho parametru text, jinak nevraci nic, ale zapise do textoveho souboru s odpovedmi novou odpoved.
 * @throws Exception
 */
function addAnswer($databaseId, $text, $autor){

    if (!empty($text)){
        $random = bin2hex(random_bytes(10));

        $answer = new Answer();
        $answer->id = $random;
        $answer->answer = trim(htmlspecialchars($text));
        $answer->autor = trim(htmlspecialchars($autor));

        $answerToAdd = json_encode($answer);

    file_put_contents($databaseId.".txt", $answerToAdd.PHP_EOL, FILE_APPEND);
    return null;

    }
    return "Pole není vyplněné!";
}

/**
 * Vypisuje vsechny odpovedi na diskuzi pro přihlášeného uživatele.
 *
 * @param $answers
 * List odpovedi pro diskuze
 * @param $loggedUser
 * uzivatelske jmeno zalogovaneho uzivatele
 * @param $admin
 * Parametr urcujici admina (tvurce) diskuze
 */
function loadAnswers($answers, $loggedUser, $admin){
    foreach ($answers as $answer){
        if ($answer !== null) {
            $autor = $answer->autor;
            echo ' <p><i class="fas fa-user-circle"></i> ' . $answer->autor . '</p>';

            if ($loggedUser == $autor || $loggedUser == $admin) {
                echo '  
                    <form method="post" action="#">
                           <input type="hidden" name="id" value="' . $answer->id . '">
                           <button class="deleteBtn" type="submit" name="delete"><i class="fas fa-backspace"></i></button>
                    </form>';
            }

            echo '<div class="topicAns">
                <span>' . $answer->answer . '</span>
             </div><br>
                       ';
        }
    }
}

/**
 * Vypisuje vsechny odpovedi na diskuzi pro nepřihlášeného uživatele.
 *
 * @param $answers
 * List odpovedi pro diskuze
 */
function loadAnswersIfNotLogged($answers){
    foreach ($answers as $answer){
        if ($answer !== null) {
            echo ' <p><i class="fas fa-user-circle"></i> ' . $answer->autor . '</p>';

            echo '<div class="topicAns">
                <span>' . $answer->answer . '</span>
             </div><br>
                       ';
        }
    }
}

/**
 * Funkce urcuje zda muze klient odpovedet na diskuzi.
 *
 * @param $loggedUser
 * Zalogovany uzivatel (objekt)
 */
function canAnswer($loggedUser){
    $token = addCsrfToken();

    if ($loggedUser == null){
        echo "<a>Odpovědět mohou pouze <a href='../Login.php' class='mainInfo'>přihlášení uživatelé. </a></p>";
    }
    else{
        echo '            
             <form class="form" method="post">
                <label>
                    <textarea class="typeAnswer" name="answer" placeholder=" Odpovědět " required="required" ></textarea>
                </label><br>
                <input type="hidden" name="token" value="'.$token.'">
                <button type="submit" class="submitDiscuss" name="send"><i class="far fa-2x fa-comment-dots"></i></button>

            </form>
            ';
    }
}

/**
 * Funkce určuje zda zobrazit odkaz na logovani nebo na stránku uživatele.
 * @param $loggedUser
 * Zalogovany uzivatel (objekt)
 */
function loginOrName($loggedUser){
    if ($loggedUser == null){
        echo '<a href="Login.php" class="login"><p><i class="fas fa-user"></i> LOGIN</p></a>';
    }
    else{
       echo '<a href="databaze/users/'.$loggedUser->username.'.php" class="login"><p><i class="fas fa-user"></i> '.$loggedUser->username.'</p></a>';
    }
}

/**
 * Funkce určuje zda zobrazí odkaz na logovaní nebo na stránku uživatele na stránkách diskuzí.
 * @param $loggedUser
 * Zalogovany uzivatel (objekt)
 */
function loginOrNameForDb($loggedUser){
    if ($loggedUser == null){
        echo '<a href="../Login.php" class="login"><p><i class="fas fa-user"></i> LOGIN</p></a>';
    }
    else{
        echo '<a href="users/'.$loggedUser->username.'.php" class="login"><p><i class="fas fa-user"></i> '.$loggedUser->username.'</p></a>';
    }
}

/**
 * Funkce vytváří list diskuzí pro stránku uživatele.
 *
 * @param $loggedUser
 * Jmeno zalogovaneho uzivatele
 * @return array
 * Vraci list diskuzi, ktere vytvoril uzivatel
 */
function loadMyDiscussion($loggedUser){
    if (!file_exists("../main/dbDiscuss.txt")){
        $create = fopen("../main/dbDiscuss.txt", "w");
        fclose($create);
    }

    $allDiscuss = file_get_contents("../main/dbDiscuss.txt");
    $field = explode(PHP_EOL, $allDiscuss);

    $resultDiscussion = array();
    foreach ($field as $diskuze){

        if($diskuze !== ""){
            $saveDiscuss = json_decode($diskuze);
            if ($saveDiscuss->autor == $loggedUser) {

                $discussion = new Diskuze();
                $discussion->headline = $saveDiscuss->headline;
                $discussion->textarea = $saveDiscuss->textarea;
                $discussion->page = $saveDiscuss->page;
                $discussion->autor = $saveDiscuss->autor;

                array_push($resultDiscussion, $discussion);
            }
        }
    }

    return $resultDiscussion;
}


/**
 * Funkce vzpíše diskuze vytvorene uzivatelem na stránce uživatele se strankovanim a filtrované dle přihlášenho uživatele.
 *
 * @param $diskuze
 * List diskuzi
 * @param $loggedUser
 * Zalogovany uzivatel (objekt)
 * @param $namePage
 * Nazev stranky (id) pro naleznuti spravneho textoveho souboru s databazi odpovedi
 */
function echoMyDiscussion($diskuze, $loggedUser, $namePage){
    $diskuzeRev = array_reverse($diskuze);
    $resultsOnPage = 7;
    $countDatabase = count($diskuze);
    $numberOfPages = ceil($countDatabase/$resultsOnPage);

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page > $numberOfPages){
            $page = 1;
        }
    } else {
        $page = 1;
    }

    $firstResult = ($page-1)*$resultsOnPage;
    $db = array_slice($diskuzeRev, $firstResult,  $resultsOnPage);

    foreach ($db as $tema) {
        if ($tema->autor == $loggedUser->username) {
            if (strlen($tema->headline) > 115){
                $temaHeadline = substr($tema->headline, 0, 115)." ....";
            }else{
                $temaHeadline =$tema->headline;
            }
            echo '
                    <div class="diskuze">
                        <a href="../' . $tema->page . '.php" class="open">otevřít</a> <i class="far fa-comments"></i> <span class="topic">' . $temaHeadline . '</span> 
                        <form method="post" action="#" class="delete">
                            <input type="hidden" name="page" value="' . $tema->page . '">
                            <button type="submit" class="delButton" name="delete"><i class="fas fa-2x fa-trash-alt"></i></button>
                        </form>
                        <form method="post" action="edit/editDiskuze.php">
                           <input type="hidden" name="page" value="' . $tema->page . '">
                           <input type="hidden" name="headline" value="' . $tema->headline . '">
                           <input type="hidden" name="textarea" value="' . $tema->textarea . '">
                           <button class="editBtn" type="submit" name="edit"><i class="fas fa-edit"></i> EDITOVAT</button>
                        </form>

                    </div>
                            ';
        }
    }
    echo "<div class='page'>";
    if ($page > 1) {
        echo '<a class="paging-arrow" href="'.$namePage.'.php?page=' . ($page - 1) . '"><i class="fas fa-angle-double-left"></i></a>';
    }
    for ($pageNum = 1;$pageNum <= $numberOfPages; $pageNum ++) {
        if($page == $pageNum){
            echo '<span  id="onPage">'.$pageNum.'</span>';
        }
        else {
            echo '<a class="paging" href="' . $namePage . '.php?page=' . $pageNum . '">' . $pageNum . '</a>';
        }
    }
    if (count($db) == $resultsOnPage) {
        echo '<a class="paging-arrow" href="'.$namePage.'.php?page=' . ($page +1 ) . '"><i class="fas fa-angle-double-right"></i></a>';
        }
    echo "</div>";

}

/**
 * Funkce vytváří CSRF token.
 *
 * @return string
 * Vraci nahodne vygenerovany retezec, ktery ja value pro CSRF token
 * @throws Exception
 */
function addCsrfToken(){
    $token = bin2hex(random_bytes(25));
    $_SESSION["csrf"] = $token;
    return $token;
}

/**
 * Funkce kontroluje zda je CSRF token stejný.
 *
 * @param $tokenToCheck
 * Hodnota CSRF tokenu
 * @return bool
 * Vraci zda je $tokenToCheck stejny jako hodnota tokenu na prohlizeci
 */
function checkCsrfToken($tokenToCheck){
    if ($_SESSION["csrf"] === $tokenToCheck){
        unset($_SESSION["csrf"]);
        return true;
    }
    else{
        return false;
    }
}

/**
 *
 * Funkce vytváří login token.
 * @return string
 * Vraci hodnotu nahodne vygenerovaneho tokenu tvoreneho pri registraci nebo prihlaseni
 * @throws Exception
 */
function addLoginToken(){
    $token = bin2hex(random_bytes(25));
    $_SESSION["logToken"] = $token;
    return $token;
}

/**
 * Funkce kontroluje zda je login token stejný.
 *
 * @param $tokenToCheck
 * Hodnota tokenu pro registraci nebo prihlaseni
 * @return bool
 * Vraci zda je hodnota $tokenToCheck stejna jako token nastaveny na prohlizeci
 */
function checkLoginToken($tokenToCheck){
    if ($_SESSION["logToken"] === $tokenToCheck){
        unset($_SESSION["logToken"]);
        return true;
    }
    else{
        return false;
    }
}

/**
 * Funkce vytváčí list diskuzí.
 *
 * @return array
 * Vraci list jednotlivych diskuzi z textoveho souboru pro databazi diskuzi pro naleznuti urcite diskuze
 */
function loadToFindDiscussion(){

    $allDiscuss = file_get_contents("main/dbDiscuss.txt");
    $field = explode(PHP_EOL, $allDiscuss);

    $resultDiscussion = array();
    foreach ($field as $diskuze){

        if($diskuze !== ""){
            $saveDiscuss = json_decode($diskuze);

            $discussion = new Diskuze();
            $discussion->headline = $saveDiscuss->headline;
            $discussion->textarea = $saveDiscuss->textarea;
            $discussion->page = $saveDiscuss->page;
            $discussion->autor = $saveDiscuss->autor;

            array_push($resultDiscussion, $discussion);

        }
    }

    return $resultDiscussion;
}

/**
 * Funkce vypíše titulek a text diskuze na dané stránce diskuze.
 *
 * @param $diskuze
 * List vsech diskuzi
 * @param $namePage
 * Parametr podle, ktere se najde prislusna diskuze, ktera se vyprintuje
 */
function echoDiscussion($diskuze, $namePage){
    foreach ($diskuze as $tema) {
        if ($tema->page === "$namePage") {
            echo '<h1 id="h1">'.$tema->headline.'</h1>
            <p>'.$tema->textarea.'</p>';
        }
    }
}

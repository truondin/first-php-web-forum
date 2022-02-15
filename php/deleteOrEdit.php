<?php
/**
 * Funkce hledá určitou diskuzi podle parametru $find
 *
 * @param $find
 * Parametr podle ktereho chceme naleznout diskuzi
 * @return mixed|null
 * Vraci naleznutou diskuzi nebo nevraci nic pokud nebyla diskuze naleznuta
 */
function findDiscussion($find){
    $diskuze = forEditDiscussion();

    foreach ($diskuze as $tema){
        if ($tema->page === $find){
            return $tema;
        }
    }
    return null;
}

/**
 * Funkce vytvoří list všech diskuzí
 *
 * @return array
 * Vrací list diskuzí pro user page
 */
function forEditDiscussion(){

    $allDiscuss = file_get_contents("../../main/dbDiscuss.txt");
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
 * Funkce nahradí určitou diskuzi za nově vytvořenou (editovanou)
 *
 * @param $page
 * Parametr nazvu (id) stranky, pro naleznuti v databazi diskuzi
 * @param $headline
 * Nove vytvoreny titulek
 * @param $textarea
 * Nove vytvoreny text v diskuzi
 * @param $autor
 * Jmeno autora editujici diskuzi
 */
function editDiscussion($page, $headline, $textarea, $autor){
    $found = findDiscussion($page);
    $replace = createEdit($page, $headline, $textarea, $autor);

    $edit = json_encode($found);
    $file = file_get_contents("../../main/dbDiscuss.txt");
    $newFile = str_replace($edit, $replace, $file);
    file_put_contents("../../main/dbDiscuss.txt", $newFile);


}

/**
 * Funkce vytváří novou diskuzi, která nahradí původní
 *
 * @param $page
 * Nazev (id) stranky diskuze
 * @param $headline
 * Nove vytvoreny titulek editovane diskuze
 * @param $textarea
 * Nove vytvoreny text editovane diskuze
 * @param $autor
 * Uzivatelske jmeno autora diskuze
 * @return false|string|null
 * Vraci editovanou (znovu vytvorenou) diskuzi nebo nevraci nic v pripade prazdnych parametru $headline a $textarea
 */
function createEdit($page, $headline, $textarea, $autor){
    if (!empty($headline && !empty($textarea))){

        $discussion = new Diskuze();
        $discussion->headline = trim(htmlspecialchars($headline));
        $discussion->textarea = trim(htmlspecialchars($textarea));
        $discussion->page = $page;
        $discussion->autor = trim(htmlspecialchars($autor));

        return json_encode($discussion);

    }
    return null;
}

/**
 * Odstraní (nahradí diskuzi za prázdné místo) diskuzi z databáze diskuzí
 *
 * @param $delete
 * Diskuze, ktera se ma odstranit
 */
function deleteDiscussion($delete){
    $deleteThis = json_encode($delete);
    $file = file_get_contents("../main/dbDiscuss.txt");
    $newFile = str_replace($deleteThis,"", $file);
    file_put_contents("../main/dbDiscuss.txt", $newFile);
    unlink("../$delete->page.txt");
    unlink("../$delete->page.php");
}

/**
 * Funkce odstraní odpověď z databáze odpovědí na diskuzi
 *
 * @param $delete
 * Odpoved ktera se ma odstranit
 * @param $db
 * Nazev textoveho souboru (databaze), kde jsou ulozeny odpovedi na diskuzi
 */
function deleteAnswer($delete, $db){
    $deleteThis = json_encode($delete);
    $file = file_get_contents("$db.txt");
    $newFile = str_replace($deleteThis,"", $file);
    file_put_contents("$db.txt", $newFile);
}


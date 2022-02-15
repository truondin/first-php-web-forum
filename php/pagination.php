<?php
/**
 * Funkce vykresluje stránkování odpovědí na stránce diskuze.
 *
 * @param $page
 * Cislo urcuji na ktere strance je uzivatel
 * @param $numOfPages
 * Pocet stranek
 * @param $pageName
 * Jmeno stranky (id) s danou diskuzi
 */
function changePage($page, $numOfPages, $pageName){
    if ($page == 1) {
        echo '<span class="arrowOff"><i class="fas fa-sort-up"></i></span>';
    }
    else{
        echo '<a class="arrow" href="'.$pageName.'.php?page=' . ($page - 1) . '"><i class="fas fa-sort-up"></i></a>';
    }

    if ($page == $numOfPages) {
        echo '<span class="arrowOff"><i class="fas fa-sort-down"></i></span>';
    }
    else{
        echo '<a class="arrow" href="'.$pageName.'.php?page=' . ($page + 1 ) . '"><i class="fas fa-sort-down"></i></a>';
    }

}

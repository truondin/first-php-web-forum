<?php

/**
 * Class Diskuze
 * Objekt Diskuze je
 * definovan:
 * tilulkem ($headline);
 * vnitrnim textem ($textarea);
 * nazvem stranky (take jako id), ktere je nahodne generovan ($headline);
 * autorem diskuze ($autor), kterym je zalogovany uzivatel
 *
 */
class Diskuze{

    public $headline;
    public $textarea;
    public $page;
    public $autor;

}

/**
 * Class Answer
 * Objekt Answer (odpoved) je
 * definovan:
 * nahodne vygenerovanym id ($id);
 * textem odpovedi (answer);
 * jmenem autora odpovedi ($autor), kterym je zalogovany uzivatel
 */
class Answer{
    public $id;
    public $answer;
    public $autor;
}

/**
 * Class User
 * Objekt uzivatele je
 * definovany:
 * uzvatelskym jmenem ($username);
 * emailem uzivatele ($email);
 * heslem uzivatele ($password)
 */
class User{
    public $username;
    public $email;
    public $password;

}

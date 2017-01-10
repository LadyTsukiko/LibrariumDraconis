<?php
if (!isset($_SESSION)) {session_start();}
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 09.01.2017
 * Time: 16:08
 */

    echo '<h3>'.$cart.'</h3>';


if ($this->controller->isLoggedIn()) {
    echo $this->controller->showCart();
    echo '<a href="index.php?action=checkout" class="button confirm">' .$order. '</a>';
}else{
    echo '<a href="index.php?action=login" class="button confirm">' .$login. '</a>';
}



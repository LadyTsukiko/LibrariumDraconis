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
    $_SESSION['order']=$order;
    $_SESSION['updatecart']=$updatecart;
    echo $this->controller->showCart($by, $remove);

}else{
    echo '<a href="index.php?action=login" class="button confirm">' .$login. '</a>';
}



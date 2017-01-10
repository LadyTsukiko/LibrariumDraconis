<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 09.01.2017
 * Time: 21:15
 */

    echo '<h3>'.$ordermsg.'</h3>';
echo '<p>Testing some stuff here</p>';
    session_start();
    $data = $_SESSION['address'];
/**
  echo  '<p>Testing some stuff here'.$deliveryaddress.': '.$data('name').' '.$data('surname').' </p>
        <p>'.$data('street').' '.$data('streetnumber').'</p>
        <p>'.$data('zip').' '.$data('city').' </p>';


 */
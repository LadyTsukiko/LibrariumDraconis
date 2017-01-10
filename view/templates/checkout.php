<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 09.01.2017
 * Time: 16:50
 */

    echo '<h3>'.$checkout.'</h3>';

    session_start();
    $data = $_SESSION['address'];

    echo '<form action="index.php?action=checkout" method="post">
    <div id="address">
        <p><input class="field checkout" placeholder="'.$name.'" name="name" value="'.$data['name'].'" required></p>
        <p><input class="field checkout" placeholder="'.$surname.'" name="surname" value="'.$data['surname'].'" required></p>
        <p><input class="field city" placeholder="'.$street.'" name="street" value="'.$data['street'].'" required> <input class="field zip" placeholder="'.$streetnumber.'" name="streetnumber" value="'.$data['streetnumber'].'" required></p>
        <p><input class="field city" placeholder="'.$city.'" name="city" value="'.$data['city'].'" required> <input class="field zip" placeholder="'.$zip.'" name="zip" value="'.$data['zip'].'" required></p>
    </div>
<p><input class="button confirm" type="submit" name="buttonOrder" value="'.$order.'"></p>';





<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 09.01.2017
 * Time: 21:15
 */

    echo '<h3>'.$ordermsg.'</h3>';

    session_start();
    //$data = $_SESSION['address'];

    $data=Address::getAddress(Address::getID($_SESSION['user']));

    if(isset($_SESSION["cart"])) {
        echo
            '<div id="ordered">
      <div class="box title">
      <p>' . $deliveryaddress . ':</p>
    <div class="box">
        <p>' . $data['name'] . ' ' . $data['surname'] . ' </p>
        <p>' . $data['street'] . ' ' . $data['streetnumber'] . '</p>
        <p>' . $data['zip'] . ' ' . $data['city'] . ' </p>
        </div>
        </div>';

        echo
            '<div class="box title">
      <p>' . $orderedbooks . ':</p>
    <div class="box">
        ' . $this->controller->showMinCart($by) . '
        </div>
        </div>
        </div>';

        $this->controller->addToDB();
    }
?>
<div>
    <a href="index.php?action=table" class="button add"><?php echo $home; ?></a>
</div>
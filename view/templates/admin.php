<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11/01/2017
 * Time: 09:19
 */
session_start();
if($_SESSION["admin"]){
if($_GET["op"]=="remove" && $_GET["order"]=="ords" ){
    $sql = "DELETE FROM `orders` WHERE id_book = ".$_GET["idb"]."AND id_cust =".$_GET["idc"];
    DB::doQuery($sql);
}
if($_GET["op"]=="remove" && $_GET["order"]=="cust" ){
    $sql = "DELETE FROM `customers` WHERE id =".$_GET["idc"];
    DB::doQuery($sql);
}

if ($_GET["order"]=="ords"){
    echo "<a href='index.php?action=admin&order=cust'>Display customers</a>";
    $sql="SELECT quantity, username, email, bookLabel, id_book, id_cust FROM orders NATURAL JOIN customers NATURAL JOIN books";
    $result = DB::doQuery($sql);
    if ($result->num_rows > 0) {
        // output data of each row

        echo "<table><tr><th>Username</th><th>Email</th><th>Title</th><th>Quantity</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["username"]."</td><td>".$row["email"]."</td><td> ".$row["bookLabel"]."</td><td> ".$row["quantity"];
            echo "</td><td><a href='index.php?action=admin&order=ords&op=remove&idb=".$row['id_book']."&idc=".$row['id_cust']."'>remove</a></td></tr>";
        }
        echo "</table>";
} }
elseif ($_GET["order"]=="cust"){
    echo "<a href='index.php?action=admin&order=ords'>Display orders</a>";
   $sql="SELECT username, email , id FROM customers";
    $result = DB::doQuery($sql);
    if ($result->num_rows > 0) {
        // output data of each row

        echo "<table><tr><th>Username</th><th>Email</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["username"]."</td><td>".$row["email"];
            echo "</td><td><a href='index.php?action=admin&order=cust&op=remove&idc=".$row['id']."'>remove</a></td></tr>";
        }
        echo "</table>";
}}

else{
    echo "<a href='index.php?action=admin&order=ords'>Display orders</a>";
    echo "<a href='index.php?action=admin&order=cust'>Display customers</a>";
}}
else{
    echo "<h3>Access Denied!</h3>";
}
<?php

/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 09.01.2017
 * Time: 17:18
 */
class Address
{

    public static function storeAddress($id,$name,$surname,$street,$stretnumber,$city,$zip){
        $query = "INSERT INTO address (id, name, surname, street, streetnumber, city, zip) VALUES('$id','$name','$surname','$street','$stretnumber','$city','$zip')";
        $res = DB::doQuery($query);
        return;
    }
    public static function updateAddress($id,$name,$surname,$street,$stretnumber,$city,$zip){
        $query = "UPDATE address SET name='$name', surname='$surname', street='$street', streetnumber='$stretnumber', city='$city', zip='$zip')WHERE id='$id'";
        $res = DB::doQuery($query);
        return;
    }

    public static function getAddress($id){
        $query = "SELECT name, surname, street, streetnumber, city, zip FROM address WHERE id = '$id'";
        $res = DB::doQuery($query);
        $row= $res->fetch_assoc();
        return $row;
    }
    public static function checkIfAddressExists($id){
        $query = "SELECT name FROM address WHERE id ='$id'";
        $res = DB::doQuery($query);
        $row= $res->fetch_assoc();
        if($row['name']!= "NULL" && $row['name'] !=""){
            return true;
            return false;
        }

    }
    public static function getID($login){
        $query = "SELECT id FROM customers WHERE username='$login'";
        $res = DB::doQuery($query);
        $row= $res->fetch_assoc();
        return $row['id'];
    }
}
<?php
class User {



    public static function checkCredentials($login, $pw) {
        $query = "SELECT password FROM customers WHERE username='$login'";
        $res = DB::doQuery($query);
        $row= $res->fetch_assoc();

        return ($row['password']==$pw );

    }

    public static function registerUser($login, $pw, $email){
        $query = "INSERT INTO customers(username,email,password) VALUES('$login','$email','$pw')";
        $res = DB::doQuery($query);
        return true;
    }
}

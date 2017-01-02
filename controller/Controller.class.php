<?php


class Controller {

    private $data = array();
    private $title = 'Librarium Draconis';
//Here go all functions

    public function home($request) {
        $this->data["message"] = "Hello World!";
        $this->title = "Home";
    }

    public function login($request) {
        $login = $request->getParameter('login', '');
        $pw = $request->getParameter('pw', '');
        if ($login && $pw) {
            if (!User::checkCredentials($login, $pw)) {
                $this->data["message"] = "Sorry, wrong credentials!";
                return;
            } else {
                $this->startSession();
                $_SESSION['user'] = $login;
                $this->data["message"] = "Hi ".ucfirst($login)." you just logged in!";
                return 'home';
            }
        }
    }

    public function logout($request) {
        $this->startSession();
        session_destroy();
        $_SESSION = array();
        $this->data["message"] = "You just logged out!";
        return 'home';
    }

    // H E L P E R S

    public function &getData() {
        return $this->data;
    }

    public function __call($function, $args) {
        throw new Exception("The action $function does not exist!");
    }

    public function isLoggedIn() {
        $this->startSession();
        return isset($_SESSION['user']);
    }

    public function getTitle() {
        return $this->title;
    }

    public function redirect($action) {
        header("Location: index.php?action=$action");
    }


    // P R I V A T E  H E L P E R S

    private $sessionState = false;

    private function startSession() {
        if (!$this->sessionState) {
            $this->sessionState = session_start();
        }
    }

    private function page404(){
        header("HTTP/1.1 404 Not Found");
        return 'page404';
    }

    private function internalRedirect($action, $request) {
        $tpl = $this->$action($request);
        return $tpl ? $tpl : $action;
    }
}
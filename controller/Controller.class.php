<?php


class Controller
{

    private $data = array();
    private $title = 'Librarium Draconis';
//Here go all functions
    private $sessionState = false;

    public function home($request)
    {
        $this->data["message"] = "Hello World!";
        $this->title = "Home";
        return 'home';
    }

    public function table($request)
    {
        $this->data["message"] = "Hello World!";
        $this->title = "Home";
        return 'table';
    }

    public function agb($request)
    {
        $this->data["message"] = "Hello World!";
        $this->title = "Terms";
        return 'agb';
    }

    public function book($request)
    {
        $this->data["message"] = "Hello World!";
        $this->title = "Book View";
        return 'book';
    }

    public function contact($request)
    {
        $this->data["message"] = "Hello World!";
        $this->title = "Contact";
        return 'contact';
    }

    public function about($request)
    {
        $this->data["message"] = "Hello World!";
        $this->title = "About";
        return 'about';
    }

    public function cart($request)
    {   $this->startSession();
        $cart = $_SESSION['cart'];
        $operation = $_GET['op'];
        switch ($operation) {
            case 'add';
                if ($cart) {
                    $cart .= ','.$_GET['id'];

                } else {
                    $cart = $_GET['id'];
                }
                break;
            case 'delete';
                if ($cart) {
                    $items = explode(',', $cart);
                    $newcart = '';
                    foreach ($items as $item) {
                        if ($_GET['id'] != $item) {
                            if ($newcart != '') {
                                $newcart .= ',' . $item;
                            } else {
                                $newcart = $item;
                            }
                        }
                    }
                    $cart = $newcart;
                }
                break;
            case
            'update';
                if ($cart) {
                    $newcart = '';
                    foreach ($_POST as $key => $value) {
                        if (stristr($key, 'qty')) {
                            $id = str_replace('qty', '', $key);
                            $items = ($newcart != '') ? explode(',', $newcart) : explode(',', $cart);
                            $newcart = '';
                            foreach ($items as $item) {
                                if ($id != $item) {
                                    if ($newcart != '') {
                                        $newcart .= ',' . $item;
                                    } else {
                                        $newcart = $item;
                                    }
                                }
                            }
                            for ($i = 1; $i <= $value; $i++) {
                                if ($newcart != '') {
                                    $newcart .= ',' . $id;
                                } else {
                                    $newcart = $id;
                                }
                            }
                        }
                    }
                }
                $cart = $newcart;
                break;
        }
        $_SESSION['cart'] = $cart;
                return 'cart';
        }

   public function showCart($by, $remove)
        {   $this->startSession();
            $cart = $_SESSION['cart'];
            if ($cart) {
                $items = explode(',', $cart);
                $contents = array();
                foreach ($items as $item) {
                    $contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
                }
                $output[] = '<form action="index.php?action=cart&op=update" method="post">';
                $output[] = '<div class="box">';
                $output[] = '<table class="cart">';

                foreach ($contents as $id => $qty) {
                    $sql = 'SELECT * FROM books WHERE ID = ' . $id;
                    $result = DB::doQuery($sql);
                    $row = $result->fetch_assoc();
                    $output[] = '<tr>';
                    $output[] = '<td><a href="index.php?action=cart&op=delete&id=' . $id . '" class="r">'.$remove.'</a></td>';
                    $output[] = '<td>' .$row['bookLabel'] . $by  . $row['authorLabel'] . '</td>';
                    $output[] = '<td><input type="text" name="qty' . $id . '" value="' . $qty . '" size="3" maxlength="3" /></td>';
                    $output[] = '</tr>';
                }
                $output[] = '</table>';
                $output[] = '</div>';
                $output[] = '<div><a href="index.php?action=checkout" class="button confirm cart">'.$_SESSION['order'].'</a>';
                $output[] = '<button type="submit" class="button confirm cart">'.$_SESSION['updatecart'].'</button></div>';
                $output[] = '</form>';
            } else {
                $output[] = '<p>Your shopping cart is empty.</p>';
            }
            return implode('', $output);
        }
        public function showMinCart($by)
        {
            $this->startSession();
            $cart = $_SESSION['cart'];
            if ($cart) {
                $items = explode(',', $cart);
                $contents = array();
                foreach ($items as $item) {
                    $contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
                }
                $output[] = '<table class="cart">';
                foreach ($contents as $id => $qty) {
                    $sql = 'SELECT * FROM books WHERE ID = ' . $id;
                    $result = DB::doQuery($sql);
                    $row = $result->fetch_assoc();
                    $output[] = '<tr>';
                    $output[] = '<td>' .$row['bookLabel'] . $by . $row['authorLabel'] . '</td>';
                    $output[] = '</tr>';
                }
                $output[] = '</table>';
            } else {
                $output[] = '<p>You shopping cart is empty.</p>';
            }
            return implode('', $output);
        }

        public
        function login($request)
        {
            $login = trim($request->getParameter('login', ''));
            $pw = trim($request->getParameter('pw', ''));


            $login = strip_tags($login);
            $login = htmlspecialchars($login);


            $pw = strip_tags($pw);
            $pw = htmlspecialchars($pw);

            if ($login && $pw) {
                $passHash = hash('sha256', $pw);
                if (!User::checkCredentials($login, $passHash)) {
                    $this->data["message"] = "Sorry, wrong credentials!";
                    return;
                } else {

                    $this->startSession();
                    $_SESSION['user'] = $login;
                    $_SESSION['admin'] = User::checkAdmin($login);
                    $test = $_SESSION['admin'];
                    $this->data["message"] = "Hi " . ucfirst($login) . " you just logged in!";
                    $this->title = "Home";
                    return 'table';
                }
            }
        }

        private
        function startSession()
        {
            if (!$this->sessionState) {
                $this->sessionState = session_start();
            }
        }

        public
        function register($request)
        {

            $login = trim($request->getParameter('login', ''));
            $login = strip_tags($login);
            $login = htmlspecialchars($login);

            $email = trim($request->getParameter('email', ''));
            $email = strip_tags($email);
            $email = htmlspecialchars($email);

            $pw = trim($request->getParameter('pw', ''));
            $pw = strip_tags($pw);
            $pw = htmlspecialchars($pw);


            if ($login && $pw && $email) {
                $passHash = hash('sha256', $pw);
                User::registerUser($login, $passHash, $email);
                return 'login';
            }

        }

        public
        function logout($request)
        {
            $this->startSession();
            session_destroy();
            $_SESSION = array();
            $this->data["message"] = "You just logged out!";
            $this->title = "Home";
            return 'table';
        }

        // H E L P E R S

        public
        function checkout($request)
        {
            $this->startSession();
            $login = $_SESSION['user'];
            $id = Address::getID($login);

            if (Address::checkIfAddressExists($id)) {

                if (isset($_POST['buttonOrder'])) {
                    return 'order';
                }

                $row = Address::getAddress($id);
                $_SESSION['address'] = $row;

                return;


            } else {
                $name = trim($request->getParameter('name', ''));
                $name = strip_tags($name);
                $name = htmlspecialchars($name);

                $surname = trim($request->getParameter('surname', ''));
                $surname = strip_tags($surname);
                $surname = htmlspecialchars($surname);

                $street = trim($request->getParameter('street', ''));
                $street = strip_tags($street);
                $street = htmlspecialchars($street);

                $streetnumber = trim($request->getParameter('streetnumber', ''));
                $streetnumber = strip_tags($streetnumber);
                $streetnumber = htmlspecialchars($streetnumber);

                $city = trim($request->getParameter('city', ''));
                $city = strip_tags($city);
                $city = htmlspecialchars($city);

                $zip = trim($request->getParameter('zip', ''));
                $zip = strip_tags($zip);
                $zip = htmlspecialchars($zip);

                if ($name && $surname && $street && $streetnumber && $city && $zip) {
                    Address::storeAddress($id, $name, $surname, $street, $streetnumber, $city, $zip);
                    return 'order';
                }
            }

        }

        public
        function order($request)
        {
            $this->data["message"] = "Hello World!";
            $this->title = "Order";
            return 'order';

        }

        public
        function &getData()
        {
            return $this->data;
        }

        public
        function __call($function, $args)
        {
            throw new Exception("The action $function does not exist!");
        }

        public
        function isLoggedIn()
        {
            $this->startSession();
            return isset($_SESSION['user']);
        }

    public  function addToDB($request){
        $this->startSession();
        $cart = $_SESSION['cart'];
        if ($cart) {
            $items = explode(',', $cart);
            $contents = array();
            foreach ($items as $item) {
                $contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
            }
            //$output[] = '<form action="index.php?action=cart&op=update" method="post" id="cart">';
            $sql = "INSERT INTO `orders`(`id_book`, `id_cust`, `quantity`) VALUES ";
            foreach ($contents as $id => $qty) {
                $sql .= "( $id, ".Address::getID($_SESSION['user']).", $qty),";
            }
            $sql = rtrim($sql, ",");
            DB::doQuery($sql);
            unset( $_SESSION['cart']);
    }}

    public function admin($request){
        return 'admin';
    }
        // P R I V A T E  H E L P E R S

        public
        function getTitle()
        {
            return $this->title;
        }

        public
        function redirect($action)
        {
            header("Location: index.php?action=$action");
        }

        private
        function page404()
        {
            header("HTTP/1.1 404 Not Found");
            return 'page404';
        }

        private
        function internalRedirect($action, $request)
        {
            $tpl = $this->$action($request);
            return $tpl ? $tpl : $action;
        }
    }
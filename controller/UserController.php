<?php

class UserController
{
    private $db;

    private $userManager;

    public function __construct($db)
    {
        require_once "./model/entity/User.php";
        require_once "../model/manager/UserManager.php";
        $this->db = $db;
        $this->userManager = new UserManager($this->db->user);
    }

    public function doLogin()
    {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        $result = $this->userManager->findOne($email);
        $passwdCorrect = sha1($password) == $result->getPassword();

        if ($result && $passwdCorrect):
            $info = "Connexion reussie";
            $_SESSION['user'] = $result;
            $page = 'home';
        else:
            $info = "Identifiants incorrects.";
        endif;
        require('./View/default.php');
    }

    public function doCreate(
    ) {
        if (
            isset($_POST['email']) &&
            isset($_POST['username']) &&
            isset($_POST['password']) &&
            isset($_POST['password_confirm'])
        ) {
            $alreadyExist = $this->userManager->findByEmail($_POST['email']);
            if (!$alreadyExist) {
                $newUser = new User([
                    "email" => $_POST["email"],
                    "username" => $_POST["username"],
                    "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
                    "createdAt" => new DateTime(),
                ]);
                $this->userManager->create($newUser);
                $info = "Utilisateur enregistré";
                $page = 'login';
            } else {
                $info = "ERREUR : Cet email (" . $_POST['email'] . ") est déjà utilisé";
                $page = 'createForm';
            }
        }
        require('./View/default.php');
    }

    public function create()
    {
        $page = 'createForm';
        require('./View/default.php');
    }

    public function home()
    {
        $page = 'home';
        require('View/default.php');
    }

    public function isConnected()
    {
        return isset($_SESSION['user']);
    }
    
    public function isAdmin()
    {
        return (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin');
    }

    public function doDisconnect()
    {
        unset($_SESSION['user']);
        $page = 'home';
        require('View/default.php');
    }

    public function profile()
    {
        $user = $this->userManager->findOne($_SESSION['user']['id']);
        if (!$user) {
            $this->doDisconnect();
            $page = 'home';
            require('View/default.php');
        } else {
            $page = 'profile';
            require('View/default.php');
        }
    }

    public function doDeleteProfile()
    {
        $this->userManager->delete($_SESSION['user']['id']);
        $this->doDisconnect();
        $page = 'home';
        require('View/default.php');
    }

    public function updateProfile()
    {
        $page = 'updateProfile';
        require('View/default.php');
    }

    public function doUpdateProfile()
    {
        $user = $this->userManager->findOne($_SESSION['user']['id']);
        if (!$user) {
            $this->doDisconnect();
            $page = 'home';
            require('View/default.php');
        } else {
            $user->setUsername($_POST['username']);
            $user->setPassword($_POST['password']);
            $this->userManager->update($user);
            $page = 'profile';
            require('View/default.php');
        }
    }
}
?>

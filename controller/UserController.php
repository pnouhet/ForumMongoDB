<?php

class UserController
{
    private $db;
    private $userManager;
    private $postManager;

    public function __construct(MongoDB\Database $db)
    {
        $this->db = $db;
        $this->userManager = new UserManager($this->db->user);
        $this->postManager = new PostManager($this->db->post);
    }

    public function doLogin(): void
    {
        $email = $_POST["email"] ?? null;
        $password = $_POST["password"] ?? null;

        $result = $this->userManager->findByEmail($email);
        $passwdCorrect = sha1($password) == $result->getPassword();

        if ($result && $passwdCorrect):
            $info = "Connexion reussie";
            $_SESSION["user"] = $result;
            $user = $result;
            $page = "profile";
        else:
            $info = "Identifiants incorrects.";
            $page = "login";
        endif;
        $posts = $this->postManager->findByUsername($user->getUsername());
        $page = "profile";
        require "./view/default.php";
    }

    public function doCreate(): void
    {
        if (
            isset($_POST["email"]) &&
            isset($_POST["username"]) &&
            isset($_POST["password"]) &&
            isset($_POST["password_confirm"])
        ) {
            $alreadyExist = $this->userManager->findByEmail($_POST["email"]);
            if (!$alreadyExist) {
                $newUser = new User([
                    "email" => $_POST["email"],
                    "username" => $_POST["username"],
                    "password" => sha1($_POST["password"]),
                    "createdAt" => date("d/m/Y H:i:s"),
                    "role" => "user",
                ]);
                $this->userManager->create($newUser);
                $info = "Utilisateur enregistré";
                $page = "login";
            } else {
                $info =
                    "ERREUR : Cet email (" .
                    $_POST["email"] .
                    ") est déjà utilisé";
                $page = "register";
            }
        }
        require "./view/default.php";
    }

    public function create(): void
    {
        $page = "register";
        require "./view/default.php";
    }

    public function login(): void
    {
        $page = "login";
        require "./view/default.php";
    }

    public function home(): void
    {
        $page = "posts";
        require "view/default.php";
    }

    public function doDisconnect(): void
    {
        unset($_SESSION["user"]);
        $page = "posts";
        $posts = $this->postManager->findAll();
        require "view/default.php";
    }

    public function profile(): void
    {
        $user = $_SESSION["user"];
        if (!$user) {
            $this->doDisconnect();
        } else {
            $page = "profile";
            $posts = $this->postManager->findByUsername($user->getUsername());
            require "view/default.php";
        }
    }

    public function doDeleteProfile(): void
    {
        $response = $this->userManager->delete($_SESSION["user"]->getId());
        if (!$response) {
            $page = "profile";
        } else {
            $this->doDisconnect();
            $page = "login";
            $info = "Utilisateur supprimé";
        }
        require "view/default.php";
    }

    public function updateProfile(): void
    {
        if (!isset($_GET["id"])) {
            $page = "profile";
        } else {
            $user = $this->userManager->findOne($_GET["id"]);
            $page = "updateProfile";
        }
        require "view/default.php";
    }

    public function doUpdateProfile(): void
    {
        $user = $this->userManager->findOne($_SESSION["user"]->getId());
        if (!$user) {
            $this->doDisconnect();
        } else {
            $user->setUsername($_POST["username"]);
            $user->setEmail($_POST["email"]);
            $response = $this->userManager->update($user);
            if ($response) {
                $_SESSION["user"] = $user;
            }
            $page = "profile";
            require "view/default.php";
        }
    }
}
?>

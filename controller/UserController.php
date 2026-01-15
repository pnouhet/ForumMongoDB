<?php

class UserController
{
    private $db;

    private $userManager;

    public function __construct(MongoDB\Database $db)
    {
        $this->db = $db;
        $this->userManager = new UserManager($this->db->user);
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
            $page = "profile";
        else:
            $info = "Identifiants incorrects.";
            $page = "login";
        endif;
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

    public function isConnected(): bool
    {
        return isset($_SESSION["user"]);
    }

    public function isAdmin(): bool
    {
        return isset($_SESSION["user"]) &&
            $_SESSION["user"]->getRole() === "admin";
    }

    public function doDisconnect(): void
    {
        unset($_SESSION["user"]);
        $page = "posts";
        require "view/default.php";
    }

    public function profile(): void
    {
        $user = $this->userManager->findOne($_SESSION["user"]->getId());
        if (!$user) {
            $this->doDisconnect();
        } else {
            $page = "profile";
            require "view/default.php";
        }
    }

    public function doDeleteProfile(): void
    {
        $this->userManager->delete($_SESSION["user"]->getId());
        $this->doDisconnect();
    }

    public function updateProfile(): void
    {
        $page = "updateProfile";
        require "view/default.php";
    }

    public function doUpdateProfile(): void
    {
        $user = $this->userManager->findOne($_SESSION["user"]->getId());
        if (!$user) {
            $this->doDisconnect();
        } else {
            $user->setUsername($_POST["username"]);
            $user->setPassword(sha1($_POST["password"]));
            $this->userManager->update($user);
            $page = "profile";
            require "view/default.php";
        }
    }
}
?>

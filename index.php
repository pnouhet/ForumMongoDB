<?php
session_start();

// Récupère l'action actuelle à partir de l'URL, par défaut « home »
$action = isset($_GET["action"]) ? htmlspecialchars($_GET["action"]) : "home";

// Message d'erreurs
$errors = [];
$message = null;

// Ajout du header
include_once "./View/header.php";

// Logique de routage
switch ($action) {
    case "register":
        // Inscription
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["register"])) {
            $username = $_POST["username"] ?? '';
            $email = $_POST["email"] ?? '';
            $password = $_POST["password"] ?? '';
            $password_confirm = $_POST["password_confirm"] ?? '';

            // Système de validation
            if (empty($username)) {
                $errors["username"] = "Un nom d'utilisateur est requis.";
            }
            if (empty($email)) {
                $errors["email"] = "Un email est requis.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Format d'email invalide.";
            }
            if (empty($password)) {
                $errors["password"] = "Mot de passe requis.";
            }
            if ($password !== $password_confirm) {
                $errors["password_confirm"] = "Les mots de passe ne correspondent pas.";
            }

            // Si aucunes erreurs, créer le compte
            if (empty($errors)) {
                $message = "Compte créé avec succès! Vous pouvez maintenant vous connecter.";
                // TODO: Enregistrer le user dans la bdd
            }
        }
        $pageTitle = "Créer un compte";
        include "View/register.php";
        include "View/footer.php";
        break;

    case 'login':
        // Connexion
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
            $email = $_POST["email"] ?? '';
            $password = $_POST["password"] ?? '';

            // Système de validation
            if (empty($email)) {
                $errors["email"] = "Email requis.";
            }
            if (empty($password)) {
                $errors["password"] = "Mot de passe requis.";
            }

            // Si aucunes erreurs, valide la connexion
            if (empty($errors)) {
                // TODO: Vérifier les infos de user dans la BDD
                $accountExists = false;
                // TODO: Remplacez la condition $accountExists = false; par la requete de verif d'email mongoDB
                // $accountExists = $userManager->getUserByEmail($email);
                
                if (!$accountExists) {
                    $errors["general"] = "Cette adresse email n'existe pas.";
                } else {
                    // TODO: Vérifier le mdp avec la BDD
                    $message = "Connexion réussie !";
                }
            }
        }
        $pageTitle = "Connexion";
        include "View/login.php";
        include "View/footer.php";
        break;

    case "home":
    default:
        $pageTitle = "Accueil";
        echo "
            <main>
                <h2>Vous n'êtes pas connecté.</h2>
                <div>
                    <p>Pour accéder au forum, veuillez vous connecter.</p>
                    <a href=\"index.php?action=login\">
                        <button type=\"button\" class=\"login-btn\">Se connecter</button>
                    </a>
                </div>
                <div>
                    <p>Vous n'avez pas de compte ?</p>
                    <a href=\"index.php?action=register\">
                        <button type=\"button\" class=\"register-btn\">S'inscrire</button>
                    </a>
                </div>
            </main>
        ";
        include "View/footer.php";
        break;
}
?>

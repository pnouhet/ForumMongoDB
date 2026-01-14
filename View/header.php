    <header>
        <div class="header-container">
            <div class="logo">
                <a href="index.php">Accueil</a>
            </div>
            <nav class="nav-links">
                <?php if (isset($_SESSION["user_id"])): ?>
                    <span>Bienvenue, <?php echo htmlspecialchars($_SESSION["username"] ?? "User"); ?></span>
                    <a href="index.php?action=home">Accueil</a>
                    <a href="index.php?action=profile">Profil</a>
                    <a href="index.php?action=logout" class="logout-btn">Déconnexion</a>
                <?php else: ?>
                    <a href="index.php?action=login">Connexion</a>
                    <span>|</span>
                    <a href="index.php?action=register">Inscription</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

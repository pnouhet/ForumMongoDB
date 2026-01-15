    <header>
        <div class="header-container">
            <div class="logo">
                <a href="index.php">Accueil</a>
            </div>
            <nav class="nav-links">
                <?php if (isset($_SESSION["user"])): ?>
                    <span>Bienvenue, <?php echo htmlspecialchars(
                        $_SESSION["user"]->getUsername(),
                    ) ?? "User"; ?></span>
                    <a href="index.php?ctrl=post&action=posts">Accueil</a>
                    <a href="index.php?ctrl=user&action=profile">Profil</a>
                    <a href="index.php?ctrl=user&action=doDisconnect" class="logout-btn">Déconnexion</a>
                <?php else: ?>
                    <a href="index.php?ctrl=user&action=login">Connexion</a>
                    <span>|</span>
                    <a href="index.php?ctrl=user&action=create">Inscription</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

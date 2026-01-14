    <div class="container">
        <div class="card">
            <h1>Créer un Compte</h1>

            <?php if (isset($message)): ?>
                <div class="success"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php?ctrl=user&action=doCreate">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        required
                        placeholder="Entrez votre nom d'utilisateur"
                    >
                    <?php if (isset($errors["username"])): ?>
                        <div class="error"><?php echo htmlspecialchars($errors["username"]); ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required
                        placeholder="Entrez votre email"
                    >
                    <?php if (isset($errors["email"])): ?>
                        <div class="error"><?php echo htmlspecialchars($errors["email"]); ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        placeholder="Entrez votre mot de passe"
                    >
                    <?php if (isset($errors["password"])): ?>
                        <div class="error"><?php echo htmlspecialchars($errors["password"]); ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password_confirm">Confirmer le mot de passe</label>
                    <input 
                        type="password" 
                        id="password_confirm" 
                        name="password_confirm" 
                        required
                        placeholder="Confirmez votre mot de passe"
                    >
                    <?php if (isset($errors["password_confirm"])): ?>
                        <div class="error"><?php echo htmlspecialchars($errors["password_confirm"]); ?></div>
                    <?php endif; ?>
                </div>

                <?php if (isset($errors["general"])): ?>
                    <div class="error">
                        <?php echo htmlspecialchars($errors["general"]); ?>
                    </div>
                <?php endif; ?>

                <button type="submit" name="register">Créer le compte</button>
            </form>

            <div class="login-section">
                <p>Vous avez déjà un compte ?</p>
                <a href="index.php?action=login">
                    <button type="button" class="login-btn">Connexion</button>
                </a>
            </div>
        </div>
    </div>

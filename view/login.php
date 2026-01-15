        <div class="card">
            <h1>Se Connecter</h1>

            <?php if (isset($info)): ?>
                            <div class="success"><?php echo htmlspecialchars(
                                $info,
                            ); ?></div>
                        <?php endif; ?>

            <form method="POST" action="index.php?ctrl=user&action=doLogin">
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
                        <div class="error"><?php echo htmlspecialchars(
                            $errors["email"],
                        ); ?></div>
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
                        <div class="error"><?php echo htmlspecialchars(
                            $errors["password"],
                        ); ?></div>
                    <?php endif; ?>
                </div>

                <?php if (isset($errors["general"])): ?>
                    <div class="error">
                        <?php echo htmlspecialchars($errors["general"]); ?>
                    </div>
                <?php endif; ?>

                <button type="submit" name="login">Se connecter</button>
            </form>

            <div class="register-section">
                <p>Pas encore de compte ?</p>
                <a href="index.php?ctrl=user&action=create">
                    <button type="button" class="register-btn">Créer un compte</button>
                </a>
            </div>
        </div>

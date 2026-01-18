        <div class="card">
            <h1>Modifier son profil</h1>

            <?php if (isset($info)): ?>
                            <div class="success"><?php echo htmlspecialchars(
                                $info,
                            ); ?></div>
                        <?php endif; ?>

            <form method="POST" action="index.php?ctrl=user&action=doUpdateProfile&id=<?= htmlspecialchars(
                $user->getId(),
            ) ?>">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        placeholder="Entrez votre email"
                        value="<?= htmlspecialchars($user->getEmail()) ?>"
                    >
                    <?php if (isset($errors["email"])): ?>
                        <div class="error"><?php echo htmlspecialchars(
                            $errors["email"],
                        ); ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        required
                        placeholder="Entrez votre nom d'utilisateur"
                        value="<?= htmlspecialchars($user->getUsername()) ?>"
                    >
                    <?php if (isset($errors["username"])): ?>
                        <div class="error"><?php echo htmlspecialchars(
                            $errors["username"],
                        ); ?></div>
                    <?php endif; ?>
                </div>

                <?php if (isset($errors["general"])): ?>
                    <div class="error">
                        <?php echo htmlspecialchars($errors["general"]); ?>
                    </div>
                <?php endif; ?>

                <button type="submit" name="update">Modifier</button>
            </form>
        </div>

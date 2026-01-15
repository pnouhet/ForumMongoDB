<section>
<h1>Profil: <?= htmlspecialchars($user->getUsername()) ?></h1>

<h2>Détails</h2>
<p>Nom d'utilisateur: <?= htmlspecialchars($user->getUsername()) ?></p>
<p>Email: <?= htmlspecialchars($user->getEmail()) ?></p>

<div>
    <a href="index.php?ctrl=user&action=update&id=<?= $user->getId() ?>">Modifier son profil</a>
    <a href="index.php?ctrl=user&action=delete&id=<?= $user->getId() ?>">Supprimer son profil</a>
</div>

<div class="user-posts">
    <h2>Posts crées</h2>
    <?php if (!empty($posts)): ?>
        <ul>
            <?php foreach ($posts as $post): ?>
                <li>
                    <?= htmlspecialchars($post["title"]) ?>
                    <span>- crée le </span>
                    <?= htmlspecialchars($post["createdAt"]) ?>
                    <span>-</span>
                    <a href="index.php?ctrl=post&action=update&id=<?= htmlspecialchars($post["_id"]) ?>">
                        <button type="button">Voir le post</button>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Vous n'avez pas encore de posts.</p>
    <?php endif; ?>
</div>

</section>

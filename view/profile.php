<section class="profile-card">
<h1>Profil de <?= htmlspecialchars($user->getUsername()) ?></h1>

<div class="user-profile">
    <h2>Vos informations</h2>
    <p>Nom d'utilisateur: <?= htmlspecialchars($user->getUsername()) ?></p>
    <p>Email: <?= htmlspecialchars($user->getEmail()) ?></p>
</div>

<div class="user-profile-btns">
    <a class="outline-btn" href="index.php?ctrl=user&action=update&id=<?= $user->getId() ?>">Modifier mes infos</a>
    <a class="outline-btn delete" href="index.php?ctrl=user&action=delete&id=<?= $user->getId() ?>">Supprimer mon compte</a>
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
                    <a href="index.php?ctrl=post&action=findOne&id=<?= htmlspecialchars($post["_id"]) ?>">
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

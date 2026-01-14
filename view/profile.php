<section>
<h1>Profil: <?= htmlspecialchars($user->getUsername()) ?></h1>

<h2>Détails</h2>
<p>Nom d'utilisateur: <?= htmlspecialchars($user->getUsername()) ?></p>
<p>Email: <?= htmlspecialchars($user->getEmail()) ?></p>

<div>
    <a href="index.php?ctrl=user&action=update&id=<?= $user->getId() ?>">Modifier son profil</a>
    <a href="index.php?ctrl=user&action=delete&id=<?= $user->getId() ?>">Supprimer son profil</a>
</div>

<h2>Posts</h2>
<?php if (!empty($posts)): ?>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
                <?= htmlspecialchars(
                    $post->getTitle(),
                ) ?> - <?= htmlspecialchars($post->getDate()) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No posts yet.</p>
<?php endif; ?>

</section>

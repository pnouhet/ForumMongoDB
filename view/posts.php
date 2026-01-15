<section>
    <h1>Les articles</h1>


        <a href="index.php?ctrl=post&action=create">
            <button type="button" class="register-btn">Créer un article</button>
        </a>

    <?php if (empty($posts)): ?>
        <p>Pas encore d'articles.</p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <article>
                <h2><?= htmlspecialchars($post["title"]) ?></h2>

                <p>
                    <?= nl2br(htmlspecialchars($post["content"])) ?>
                </p>

                <small>
                    Posté à <?= htmlspecialchars($post["createdAt"]) ?>
                    par <?= htmlspecialchars($post["username"]) ?>
                </small>

                <a href="index.php?ctrl=post&action=update&id=<?= htmlspecialchars(
                    $post["_id"],
                ) ?>">
                    <button type="button" class="register-btn">Modifier</button>
                </a>

                <a href="index.php?ctrl=post&action=doDelete&id=<?= htmlspecialchars(
                    $post["_id"],
                ) ?>">
                    <button type="button" class="register-btn">Supprimer</button>
                </a>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</section>

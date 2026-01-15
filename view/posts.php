<section class="posts">
    <h1>Les articles</h1>
        <a href="index.php?ctrl=post&action=create">
            <button type="button" class="button">Créer un article</button>
        </a>

    <div class="article-container">
        <?php if (empty($posts)): ?>
            <p>Pas encore d'articles.</p>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                    <article>
                        <div class="article-head">
                            <h2><?= htmlspecialchars($post["title"]) ?></h2>
                            <small>
                                Posté à <?= htmlspecialchars($post["createdAt"]) ?>
                                par <?= htmlspecialchars($post["username"]) ?>
                            </small>
                        </div>
                        <p>
                            <?= nl2br(htmlspecialchars($post["content"])) ?>
                        </p>
                        <div class="article-buttons">
                            <a href="index.php?ctrl=post&action=update&id=<?= htmlspecialchars(
                                $post["_id"],
                            ) ?>">
                                <button type="button" class="outline-btn">Modifier</button>
                            </a>
                            <a href="index.php?ctrl=post&action=doDelete&id=<?= htmlspecialchars(
                                $post["_id"],
                            ) ?>">
                                <button type="button" class="outline-btn delete">Supprimer</button>
                            </a>
                        </div>
                    </article>
                    <a href="index.php?ctrl=post&action=doReply&id=<?= htmlspecialchars($post["_id"],) ?>">
                        <button type="button" class="button">Répondre</button>
                    </a>
                <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

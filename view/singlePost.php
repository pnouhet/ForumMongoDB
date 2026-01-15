<div class="article-container">
    <article>
        <div class="article-head">
            <h2><?= htmlspecialchars($post->getTitle()) ?></h2>
            <small>
                Posté le <?= htmlspecialchars($post->getCreatedAt()) ?>
                par <?= htmlspecialchars($post->getUsername()) ?>
            </small>
        </div>
    
        <div class="article-content">
            <p><?= nl2br(htmlspecialchars($post->getContent())) ?></p>
        </div>
    
        <div class="article-actions">
            <?php if (
                isset($_SESSION["user"]) &&
                $_SESSION["user"]->getUsername() === $post->getUsername()
            ): ?>
                <div class="article-buttons">
                    <a href="index.php?ctrl=post&action=update&id=<?= htmlspecialchars(
                        $post->getId(),
                    ) ?>">
                        <button type="button" class="outline-btn">Modifier</button>
                    </a>
                    <a href="index.php?ctrl=post&action=doDelete&id=<?= htmlspecialchars(
                        $post->getId(),
                    ) ?>">
                        <button type="button" class="outline-btn delete">Supprimer</button>
                    </a>
                </div>
            <?php endif; ?>
    
        </div>
    </article>
    <div class="article-container-buttons">
        <a href="index.php?ctrl=post&action=posts">
            <button type="button" class="button">Retour aux posts</button>
        </a>
        <a href="index.php?ctrl=post&action=doReply&id=<?= htmlspecialchars($post->getId()) ?>">
            <button type="button" class="button">Répondre</button>
        </a>
    </div>
</div>

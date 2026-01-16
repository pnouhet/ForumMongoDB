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

    <div class="comments-container">

        <?php
        if (!function_exists('renderComments')) {
            function renderComments($comments, $parentId = null, $post) {
                foreach ($comments as $comment) {
                    $currentParentId = !empty($comment["parentId"]) ? (string)$comment["parentId"] : null;
                    $targetParentId = !empty($parentId) ? (string)$parentId : null;

                    if ($currentParentId === $targetParentId) {
                        ?>
                        <div class="comment">
                            <article>
                                <div class="article-head">
                                    <h2>Re : <?= htmlspecialchars($post->getTitle()) ?></h2>
                                    <small>
                                        Posté le <?= htmlspecialchars($comment["createdAt"]) ?>
                                        par <?= htmlspecialchars($comment["username"]) ?>
                                    </small>
                                </div>
                            
                                <div class="article-content">
                                    <p><?= nl2br(htmlspecialchars($comment["content"])) ?></p>
                                </div>

                            </article>
                            <div class="article-actions">
                                <a href="index.php?ctrl=comment&action=reply&id=<?= htmlspecialchars($post->getId()) ?>&parentId=<?= htmlspecialchars($comment["_id"]) ?>">
                                    <button type="button" class="outline-btn">Répondre</button>
                                </a>
                            </div>
                            
                            <!-- Recursive call for children -->
                            <?php renderComments($comments, (string)$comment["_id"], $post); ?>
                        </div>
                        <?php
                    }
                }
            }
        }
        ?>

        <?php if (empty($comments)): ?>
            <p>Pas encore de commentaires.</p>
        <?php else: ?>
            <?php renderComments($comments, null, $post); ?>
        <?php endif; ?>
    </div>

    <div class="article-container-buttons">
        <a href="index.php?ctrl=post&action=posts">
            <button type="button" class="button">Retour aux posts</button>
        </a>
        <a href="index.php?ctrl=comment&action=reply&id=<?= htmlspecialchars($post->getId()) ?>">
            <button type="button" class="button">Répondre au post</button>
        </a>
    </div>
</div>

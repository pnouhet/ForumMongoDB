<div class="card">
    <form method="POST" action="index.php?ctrl=comment&action=doUpdate&id=<?= htmlspecialchars(
        $comment->getId(),
    ) ?>">

        <?php if (!empty($errors)): ?>
            <div class="error">
                <?= htmlspecialchars($errors) ?>
            </div>
        <?php endif; ?>
            <div class="comment-content">
                <label for="content">Contenu</label>
                <textarea
                    id="content"
                    name="content"
                    rows="6"
                    required
                ><?= htmlspecialchars($comment->getContent()) ?></textarea>
            </div>

            <button type="submit">Modifier</button>

    </form>
</div>

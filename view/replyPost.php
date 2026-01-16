<div class="card">
    <h2>Répondre au post</h2>
    <form method="POST" action="index.php?ctrl=comment&action=doReply">
        <input type="hidden" name="postId" value="<?= htmlspecialchars($postId) ?>">
        <?php if (!empty($parentId)): ?>
            <input type="hidden" name="parentId" value="<?= htmlspecialchars($parentId) ?>">
        <?php endif; ?>

        <div class="post-content">
            <label for="content">Votre réponse</label>
            <textarea
                id="content"
                name="content"
                rows="6"
                required
            ></textarea>
        </div>

        <button type="submit">Envoyer</button>
    </form>
    
    <br>
    <a href="index.php?ctrl=post&action=findOne&id=<?= htmlspecialchars($postId) ?>">
        <button type="button" class="button">Annuler</button>
    </a>
</div>

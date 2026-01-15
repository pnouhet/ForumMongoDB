<div class="card">
    <form method="POST" action="index.php?ctrl=post&action=doUpdate&id=<?= htmlspecialchars(
        $post->getId(),
    ) ?>">
    
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?= htmlspecialchars($errors) ?>
            </div>
        <?php endif; ?>
    
            <div class="post-title">
                <label for="title">Titre du post</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    required
                    minlength="3"
                >
            </div>
    
            <div class="post-content">
                <label for="content">Contenu</label>
                <textarea
                    id="content"
                    name="content"
                    rows="6"
                    required
                ></textarea>
            </div>
    
            <button type="submit">Publier</button>
    
    </form>
</div>

<form method="POST" action="index.php?ctrl=post&action=doUpdate">

    <?php if (!empty($errors)): ?>
        <div class="error">
            <?= htmlspecialchars($errors) ?>
        </div>
    <?php endif; ?>

    <div>
        <label for="title">Title</label><br>
        <input
            type="text"
            id="title"
            name="title"
            required
            minlength="3"
        >
    </div>

    <br>

    <div>
        <label for="content">Content</label><br>
        <textarea
            id="content"
            name="content"
            rows="6"
            required
        ></textarea>
    </div>

    <br>

    <button type="submit">Publier</button>

</form>

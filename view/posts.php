<section>
    <h1>All posts</h1>

    <?php if (empty($posts)): ?>
        <p>No posts yet.</p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <article>
                <h2><?= htmlspecialchars($post->getTitle()) ?></h2>

                <p>
                    <?= nl2br(htmlspecialchars($post->getContent())) ?>
                </p>

                <small>
                    Posted on <?= htmlspecialchars($post->getDate()) ?>
                    by <?= htmlspecialchars($post->getUser()["username"]) ?>
                </small>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</section>

<section>
    <h1>All posts</h1>

    <?php if (empty($posts)): ?>
        <p>No posts yet.</p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <article>
                <h2><?= htmlspecialchars($post["title"]) ?></h2>

                <p>
                    <?= nl2br(htmlspecialchars($post["content"])) ?>
                </p>

                <small>
                    Posted on <?= htmlspecialchars($post["date"]) ?>
                    by <?= htmlspecialchars($post["user"]["username"]) ?>
                </small>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</section>

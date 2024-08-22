<!doctype html>
<html lang="en">
<?php require '../templates/head.php'; ?>
<body>

<!-- Header -->
<?php require '../templates/header.php'; ?>

<main class="container">
    <?php if (isset($blog_post)): ?>
        <article class="single-blog">
            <header class="blog-header">
                <?php if (!empty($blog_post['title'])): ?>
                    <h1 class="blog-title"><?php echo htmlspecialchars($blog_post['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
                <?php endif; ?>

                <?php if (!empty($blog_post['username'])): ?>
                    <p class="blog-author">By: <span><?php echo htmlspecialchars($blog_post['username'], ENT_QUOTES, 'UTF-8'); ?></span></p>
                <?php endif; ?>

                <?php if (!empty($blog_post['publication_date'])): ?>
                    <p class="blog-date"><?php echo htmlspecialchars($blog_post['publication_date'], ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
            </header>

            <?php if (!empty($blog_post['content'])): ?>
                <div class="blog-content">
                    <p><?php echo nl2br(htmlspecialchars($blog_post['content'], ENT_QUOTES, 'UTF-8')); ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($blog_post['category_id'])): ?>
                <footer class="blog-footer">
                    <p><strong>Category ID:</strong> <?php echo htmlspecialchars($blog_post['category_id'], ENT_QUOTES, 'UTF-8'); ?></p>
                </footer>
            <?php endif; ?>
        </article>
    <?php else: ?>
        <p>No blog post found.</p>
    <?php endif; ?>
</main>

<!-- Footer Scripts -->
<?php require '../templates/scripts/footer-scripts.php'; ?>
</body>
</html>

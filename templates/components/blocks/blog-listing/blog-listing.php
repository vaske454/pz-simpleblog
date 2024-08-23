<div class="blog-list">
    <h2 class="blog-list-title">Blog Posts</h2>
    <div class="blog-items-container">
        <?php if (!empty($blogs)): ?>
            <?php foreach ($blogs as $blog): ?>
                <a href="#" class="blog-item-link" data-blog='<?php echo htmlspecialchars(json_encode($blog), ENT_QUOTES, 'UTF-8'); ?>'>
                    <div class="blog-item">
                        <h2><?php echo htmlspecialchars(substr($blog['title'], 0, 50), ENT_QUOTES, 'UTF-8'); ?><?php echo strlen($blog['title']) > 50 ? '...' : ''; ?></h2>
                        <p><?php echo htmlspecialchars(substr($blog['content'], 0, 150), ENT_QUOTES, 'UTF-8'); ?><?php echo strlen($blog['content']) > 150 ? '...' : ''; ?></p>
                        <?php if (!empty($blog['publication_date'])): ?>
                            <p class="blog-date"><?php echo htmlspecialchars($blog['publication_date'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($blog['category_name'])): ?>
                            <p class="blog-category">Category: <i><?php echo htmlspecialchars($blog['category_name'], ENT_QUOTES, 'UTF-8'); ?></i></p>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php if (!empty($blogs)): ?>
    <?php require '../templates/components/parts/popup-blog/popup-blog.php'; ?>
<?php endif; ?>

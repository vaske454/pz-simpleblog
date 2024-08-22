<div class="blog-list">
    <h2 class="blog-list-title">Blog Posts</h2>
    <div class="blog-items-container">
        <?php if (!empty($blogs)):
            foreach ($blogs as $blog): ?>
                <a href="/single-blog?id=<?php echo htmlspecialchars($blog['id'], ENT_QUOTES, 'UTF-8'); ?>" class="blog-item-link">
                    <div class="blog-item">
                        <h2><?php echo htmlspecialchars(substr($blog['title'], 0, 50), ENT_QUOTES, 'UTF-8'); ?><?php echo strlen($blog['title']) > 50 ? '...' : ''; ?></h2>
                        <p><?php echo htmlspecialchars(substr($blog['content'], 0, 150), ENT_QUOTES, 'UTF-8'); ?><?php echo strlen($blog['content']) > 150 ? '...' : ''; ?></p>
                    </div>
                </a>
            <?php endforeach;
        endif;?>
    </div>
</div>

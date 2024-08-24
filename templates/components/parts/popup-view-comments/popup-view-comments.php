<!-- View Comments Popup -->
<div id="view-comments-popup-<?= $blog['id'] ?>" class="view-comments-popup js-view-comments-popup" style="display: none;">
    <div class="view-comments-popup-content">
        <span class="view-comments-close-popup js-view-comments-close-popup">&times;</span>
        <h2>Comments</h2>
        <div class="view-comments-list">
            <?php if (!empty($blog['comments'])): ?>
                <?php foreach ($blog['comments'] as $comment): ?>
                    <div class="comment-item">
                        <p class="comment-username"><?php echo htmlspecialchars($comment['user_name'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="comment-text"><?php echo htmlspecialchars($comment['content'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No comments yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

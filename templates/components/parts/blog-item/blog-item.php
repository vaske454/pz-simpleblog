<?php if (isset($blog)): ?>
    <div class="blog-item">
        <a href="javascript:;" class="blog-item-link" data-blog='<?php echo htmlspecialchars(json_encode($blog), ENT_QUOTES, 'UTF-8'); ?>'>
            <div>
                <?php if ($blog['is_my_post']): ?>
                    <p class="is-my-post">Editable</p>
                <?php else: ?>
                    <p class="is-my-post">Uneditable</p>
                <?php endif; ?>
                <?php if ($blog['title']): ?>
                    <h2><?php echo htmlspecialchars(substr($blog['title'], 0, 50), ENT_QUOTES, 'UTF-8'); ?><?php echo strlen($blog['title']) > 50 ? '...' : ''; ?></h2>
                <?php endif; ?>
                <?php if ($blog['content']): ?>
                    <p><?php echo htmlspecialchars(substr($blog['content'], 0, 150), ENT_QUOTES, 'UTF-8'); ?><?php echo strlen($blog['content']) > 150 ? '...' : ''; ?></p>
                <?php endif; ?>
                <?php if (!empty($blog['category_name']) || !empty($blog['publication_date'])): ?>
                <div class="blog-meta">
                    <?php if (!empty($blog['category_name'])): ?>
                        <p class="blog-category">Category: <i><?php echo htmlspecialchars($blog['category_name'], ENT_QUOTES, 'UTF-8'); ?></i></p>
                    <?php endif; ?>
                    <?php if (!empty($blog['publication_date'])): ?>
                        <p class="blog-date"><?php echo htmlspecialchars($blog['publication_date'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </a>
        <div class="blog-actions">
            <a href="javascript:;" class="view-comments js-view-comments" data-id="<?= $blog['id'] ?>">View Comments</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="javascript:;" class="add-comment js-add-comment" data-id="<?= $blog['id'] ?>">Add Comment</a>
            <?php endif; ?>
        </div>
    </div>
    <?php require '../templates/components/parts/popup-view-comments/popup-view-comments.php'; ?>
    <?php require '../templates/components/parts/popup-add-comment/popup-add-comment.php'; ?>
<?php endif; ?>
<div class="blog-list">
    <div class="blog-list-title-container">
        <h2 class="blog-list-title">Blog Posts</h2>
        <?php if (!empty($categories)): ?>
        <label for="blog-select-options">Categories:</label>
        <select id="blog-select-options" class="blog-select-options">
            <option value="">All Posts</option>
            <?php foreach ($categories as $category): ?>
            <?php if ($category['name']): ?>
                <option value="<?= htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <?php endif; ?>
    </div>
    <div class="blog-items-container">
        <?php if (!empty($blogs)): ?>
            <?php foreach ($blogs as $blog): ?>
                <?php require '../templates/components/parts/blog-item/blog-item.php'; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php if (!empty($blogs)): ?>
    <?php require '../templates/components/parts/popup-blog/popup-blog.php'; ?>
<?php endif; ?>

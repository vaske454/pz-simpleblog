<!doctype html>
<html lang="en">
<?php require '../templates/head.php'; ?>
<body>

<!-- Header -->
<?php require '../templates/header.php'; ?>

<!-- Create Blog Form -->
<div class="create-blog-form">
    <h2>Create a New Blog Post</h2>
    <form id="create-blog-form" method="post" action="/create-blog">
        <div class="blog-form-group">
            <label for="blog-title">Title:</label>
            <input type="text" id="blog-title" name="title">
            <div class="error-message" id="title-error" style="color: red; display: none;"></div>
        </div>
        <div class="blog-form-group">
            <label for="blog-content">Content:</label>
            <textarea id="blog-content" name="content" rows="5"></textarea>
            <div class="error-message" id="content-error" style="color: red; display: none;"></div>
        </div>
        <?php if (!empty($categories)): ?>
        <div class="blog-form-group">
            <label for="blog-category">Category:</label>
            <select id="blog-category" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo htmlspecialchars($category['id']); ?>">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>
        <button type="submit">Create Blog Post</button>
    </form>
</div>

<!-- Footer Scripts -->
<?php require '../templates/scripts/footer-scripts.php'; ?>
</body>
</html>

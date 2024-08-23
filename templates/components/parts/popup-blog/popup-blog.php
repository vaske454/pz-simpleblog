<!-- Blog Popup -->
<div id="blog-popup" class="blog-popup">
    <div class="blog-popup-content">
        <span class="blog-popup-close">&times;</span>
        <article class="single-blog">
            <header class="blog-header">
                <div class="blog-header-info">
                    <p class="blog-author">By: <span id="popup-blog-author"></span></p>
                    <p class="blog-date-popup" id="popup-blog-date"></p>
                </div>
                <label for="popup-blog-title">Title:</label>
                <input type="text" id="popup-blog-title" class="blog-title" placeholder="Title" />
            </header>
            <div class="blog-content">
                <label for="popup-blog-content">Content:</label>
                <textarea id="popup-blog-content" placeholder="Content"></textarea>
            </div>
            <footer class="blog-footer">
                <?php if (!empty($categories)): ?>
                <label for="popup-blog-category">Category:</label>
                <select name="popup-blog-category" id="popup-blog-category">
                    <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php endif; ?>
                <button id="save-blog-button" class="save-button">Save Changes</button>
            </footer>
        </article>
    </div>
</div>

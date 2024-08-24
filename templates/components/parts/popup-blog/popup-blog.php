<!-- Blog Popup -->
<div id="blog-popup" class="blog-popup">
    <div class="blog-popup-content">
        <span class="blog-popup-close">&times;</span>

        <!-- Update Form -->
        <form action="/update-blog" method="POST" id="update-blog-form">
            <article class="single-blog">
                <header class="blog-header">
                    <div class="blog-header-info">
                        <p class="blog-author">By: <span id="popup-blog-author"></span></p>
                        <p class="blog-date-popup" id="popup-blog-date"></p>
                    </div>
                    <label for="popup-blog-title">Title:</label>
                    <input type="text" id="popup-blog-title" name="title" class="blog-title" placeholder="Title" />
                </header>
                <div class="blog-content">
                    <label for="popup-blog-content">Content:</label>
                    <textarea id="popup-blog-content" name="content" placeholder="Content"></textarea>
                </div>
                <footer class="blog-footer">
                    <?php if (!empty($categories)): ?>
                        <label for="popup-blog-category">Category:</label>
                        <select name="category_id" id="popup-blog-category">
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?php echo $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user'])): ?>
                    <input type="hidden" id="popup-blog-id" name="id" />
                    <button type="submit" id="save-blog-button" class="save-button" name="action" value="update">Save Changes</button>
                    <?php endif; ?>
                </footer>
            </article>
        </form>

        <?php if (isset($_SESSION['user'])): ?>
        <!-- Delete Form -->
        <form action="/delete-blog" method="POST" id="delete-blog-form">
            <input type="hidden" id="delete-blog-id" name="id" />
            <button type="submit" id="delete-blog-button" class="delete-button" name="action" value="delete">Delete</button>
        </form>
        <?php endif; ?>
    </div>
</div>

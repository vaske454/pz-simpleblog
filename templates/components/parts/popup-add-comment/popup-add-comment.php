<!-- Add Comment Popup -->
<div id="add-comment-popup-<?= $blog['id'] ?>" class="add-comment-popup js-add-comment-popup" style="display: none;">
    <div class="add-comment-popup-content">
        <span class="add-comment-close-popup js-add-comment-close-popup">&times;</span>
        <h2>Add Comment</h2>
        <form action="/add-comment" id="add-comment-form-<?= $blog['id'] ?>" method="POST">
            <div class="add-comment-form-group">
                <label for="comment-text-<?= $blog['id'] ?>">Comment:</label>
                <textarea id="comment-text-<?= $blog['id'] ?>" name="comment" placeholder="Write your comment here..." required></textarea>
            </div>
            <input type="hidden" id="delete-blog-id-<?= $blog['id'] ?>" name="id" value="<?= $blog['id'] ?>" />
            <button type="submit" class="save-comment-button" name="action" value="add-comment">Save</button>
        </form>
    </div>
</div>
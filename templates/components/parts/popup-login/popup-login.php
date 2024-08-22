<div id="login-popup" class="popup">
    <div class="popup-content">
        <span class="popup-close" id="popup-close">&times;</span>
        <h2>Login</h2>
        <form class="login-popup js-login-popup" method="post" action="/login" novalidate>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <div class="error-message" id="username-error"></div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <div class="error-message" id="password-error"></div>
            </div>
            <div class="login-btn">
                <button type="submit">Login</button>
            </div>
        </form>
        <p>Don't have an account? <a href="/register">Sign up</a></p>
    </div>
</div>

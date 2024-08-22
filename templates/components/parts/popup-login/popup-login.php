<div id="login-popup" class="popup">
    <div class="popup-content">
        <span class="popup-close" id="popup-close">&times;</span>
        <h2>Login</h2>
        <form class="login-popup js-login-popup" method="post" action="/login" novalidate>
            <div class="form-group">
                <label for="username">Username:</label>
                <input class="js-username" type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <div class="password-container-login">
                    <input class="js-password" type="password" id="password" name="password">
                    <button type="button" class="js-toggle-password">Show</button>
                </div>
            </div>
            <div class="login-btn">
                <button class="login-button" type="submit">Login</button>
            </div>
        </form>
        <p>Don't have an account? <a href="/register">Sign up</a></p>
    </div>
</div>

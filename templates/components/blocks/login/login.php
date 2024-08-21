<div class="login auth-form">
    <h1>Login</h1>
    <!-- Display error message if it exists -->
    <?php if (isset($error)): ?>
        <div class="error-message">
            <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php endif; ?>
    <!-- Login form -->
    <form class="login-form" method="post" action="/login">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required aria-required="true">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required aria-required="true">
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="/register">Sign up</a></p>
    <p><a href="/">Go to Homepage</a></p>
</div>
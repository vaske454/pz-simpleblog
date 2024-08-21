<div class="register auth-form">
    <h1>Register</h1>
    <!-- Display error message if it exists -->
    <?php if (isset($error)): ?>
        <div class="error-message">
            <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php endif; ?>
    <!-- Registration form -->
    <form class="register-form" method="post" action="/register">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required aria-required="true">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required aria-required="true">
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="/login">Login</a></p>
    <p><a href="/">Go to Homepage</a></p>
</div>
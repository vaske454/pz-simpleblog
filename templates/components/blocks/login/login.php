<div class="login auth-form">
    <h1>Login</h1>
    <!-- Display error message if it exists -->
    <?php if (isset($error_message) && isset($error_code)): ?>
        <div class="error-message js-error-message">
            <p><?php
                // Format the error message with code and description
                $message = 'Code: ' . $error_code . ' - Message: ' . $error_message;
                // Output the formatted error message
                echo htmlspecialchars($message,  ENT_QUOTES, 'UTF-8');
                ?>
            </p>
        </div>
    <?php endif; ?>

    <!-- Login form -->
    <form class="login-form js-login-form" method="post" action="/login">
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
        <button class="login-button" type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="/register">Sign up</a></p>
    <p><a href="/">Go to Homepage</a></p>
</div>
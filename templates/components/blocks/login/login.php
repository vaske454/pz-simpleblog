<div class="login auth-form">
    <h1>Login</h1>
    <!-- Display error message if it exists -->
    <?php if (isset($error_message) && isset($error_code)): ?>
        <div class="error-message">
            <p><?php
                // Format the error message with code and description
                $message = 'Code: ' . htmlspecialchars($error_code, ENT_QUOTES, 'UTF-8') . ' - Message: ' . htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
                // Output the formatted error message
                echo $message;
                ?>
            </p>
        </div>
    <?php endif; ?>

    <!-- Login form -->
    <form class="login-form js-login-form" method="post" action="/login">
        <div class="form-group">
            <label for="username">Username:</label>
            <input class="js-username" type="text" id="username" name="username" required>
            <div class="error-message" id="username-error"></div>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input class="js-password" type="password" id="password" name="password" required>
            <div class="error-message" id="password-error"></div>
        </div>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="/register">Sign up</a></p>
    <p><a href="/">Go to Homepage</a></p>
</div>
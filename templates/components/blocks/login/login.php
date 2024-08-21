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
    <form class="login-form" method="post" action="/login">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <div class="error-message" id="username-error"></div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <div class="error-message" id="password-error"></div>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="/register">Sign up</a></p>
    <p><a href="/">Go to Homepage</a></p>
</div>
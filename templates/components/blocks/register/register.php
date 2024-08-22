<div class="register auth-form">
    <h1>Register</h1>
    <!-- Display error message if it exists -->
    <?php if (isset($error_message) && isset($error_code)): ?>
        <div class="error-message js-error-message">
            <p><?php
                // Format the error message with code and description
                $message = 'Code: ' . htmlspecialchars($error_code, ENT_QUOTES, 'UTF-8') . ' - Message: ' . htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
                // Output the formatted error message
                echo $message;
                ?>
            </p>
        </div>
    <?php endif; ?>
    <!-- Registration form -->
    <form class="register-form js-register-form" method="post" action="/register">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="js-username" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" class="js-password" id="password" name="password">
                <button type="button" class="js-toggle-password">Show</button>
            </div>
        </div>
        <button class="register-btn" type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="/login">Login</a></p>
    <p><a href="/">Go to Homepage</a></p>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/build/css/home.bundle.css">
</head>
<body>
<h1><a href="/">Welcome to My Blog</a></h1>
<nav>
    <ul>
        <li><a href="javascript:;" id="login-link">Login</a></li>
        <li><a href="/register">Register</a></li>
    </ul>
</nav>

<!-- Popup Login Form -->
<div id="login-popup" class="popup">
    <div class="popup-content">
        <span class="popup-close" id="popup-close">&times;</span>
        <h2>Login</h2>
        <form method="post" action="/login">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="/register">Sign up</a></p>
        <p><a href="/">Go to Homepage</a></p>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/build/js/home.bundle.js"></script>
</body>
</html>

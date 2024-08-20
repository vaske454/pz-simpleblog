<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        /* Basic styling for the popup */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
        }
        .popup-close {
            cursor: pointer;
            float: right;
            font-size: 18px;
        }
    </style>
</head>
<body>
<h1>Welcome to My Blog</h1>
<nav>
    <ul>
        <li><a href="" id="login-link">Login</a></li>
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
    </div>
</div>

<script>
    // JavaScript to handle popup display
    document.getElementById('login-link').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('login-popup').style.display = 'flex';
    });

    document.getElementById('popup-close').addEventListener('click', function() {
        document.getElementById('login-popup').style.display = 'none';
    });

    // Close popup if user clicks outside of it
    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('login-popup')) {
            document.getElementById('login-popup').style.display = 'none';
        }
    });
</script>
</body>
</html>

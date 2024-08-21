<header>
    <div class="header-content">
        <h1>
            <a href="/" aria-label="Homepage">Welcome to My Blog</a>
        </h1>
        <nav>
            <ul>
                <?php if (isset($_SESSION['user'])): ?>
                    <li>
                        <span>Welcome, <?php echo htmlspecialchars($_SESSION['user']->username); ?></span>
                    </li>
                    <li>
                        <a href="/logout" aria-label="Logout">Logout</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="javascript:;" id="login-link" aria-label="Login">Login</a>
                    </li>
                    <li>
                        <a href="/register" aria-label="Register">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

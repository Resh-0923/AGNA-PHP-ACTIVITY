<?php
require_once 'includes/config.php';
redirect_if_logged_in();

$errors   = [];
$username = '';
$alert    = null;   // ['type' => 'success'|'error', 'msg' => '...']

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // ---- validation (regular expressions) ----
    if ($username === '') {
        $errors['username'] = 'Please enter your username or email.';
    } elseif (!preg_match(RX_USERNAME, $username)) {
        $errors['username'] = 'Use 3-60 characters: letters, numbers and . _ @ + - only.';
    }

    if ($password === '') {
        $errors['password'] = 'Please enter your password.';
    }

    // ---- authentication ----
    if (!$errors) {
        $displayName = null;

        // 1) static credentials required by the assignment
        if (strtolower($username) === STATIC_USER['username'] && $password === STATIC_USER['password']) {
            $displayName = STATIC_USER['name'];
        } else {
            // 2) accounts created on the registration page
            foreach (get_users() as $u) {
                $matchesUser = ($u['email'] === strtolower($username)) || (strtolower($u['name']) === strtolower($username));
                if ($matchesUser && password_verify($password, $u['password'])) {
                    $displayName = $u['name'];
                    break;
                }
            }
        }

        if ($displayName !== null) {
            session_regenerate_id(true);
            $_SESSION['cosmos_user'] = $displayName;
            header('Location: index.php');
            exit;
        }

        $alert = ['type' => 'error', 'msg' => 'Those credentials did not check out. Please try again.'];
    }
}

// flash message coming from register.php
if (!$alert && isset($_SESSION['flash'])) {
    $alert = $_SESSION['flash'];
    unset($_SESSION['flash']);
}

$pageTitle = 'Sign in - Stellar';
$bodyClass = 'auth-page';
$skyHeading = 'Hundreds of billions of galaxies are waiting.';
$skyText    = 'Sign in to explore the galaxies and the planets of our solar system.';

include 'includes/header.php';
?>
    <main class="split">

<?php include 'includes/auth_sky.php'; ?>

        <section class="panel">
            <div class="form-wrap">
                <span class="eyebrow">Mission control</span>
                <h1>Welcome back</h1>
                <p class="lead">Sign in to continue your tour of space.</p>

                <?php if ($alert): ?>
                <div id="formAlert" class="form-alert <?= e($alert['type']) ?>" role="alert" aria-live="polite"><?= e($alert['msg']) ?></div>
                <?php endif; ?>

                <form id="loginForm" action="login.php" method="POST" class="auth-form" novalidate>
                    <div class="form-group">
                        <label for="username">Username or Email</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" autocomplete="username" value="<?= e($username) ?>" class="<?= isset($errors['username']) ? 'input-error' : '' ?>" required>
                        <?php if (isset($errors['username'])): ?><span class="error-msg"><?= e($errors['username']) ?></span><?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" autocomplete="current-password" class="<?= isset($errors['password']) ? 'input-error' : '' ?>" required>
                        <?php if (isset($errors['password'])): ?><span class="error-msg"><?= e($errors['password']) ?></span><?php endif; ?>
                    </div>

                    <div class="form-actions">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot-link">Forgot password?</a>
                    </div>

                    <button type="submit" class="submit-btn">Launch</button>
                </form>

                <p class="demo-hint">Demo login: <code>admin</code> / <code>12345</code></p>

                <p class="switch">New here? <a href="register.php">Create an account</a></p>
            </div>
        </section>

    </main>

<?php include 'includes/scripts.php'; ?>

<?php
require_once 'includes/config.php';
redirect_if_logged_in();

$errors   = [];
$fullname = '';
$email    = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm-password'] ?? '';

    // ---- Full name ----
    if ($fullname === '') {
        $errors['fullname'] = 'Please enter your full name.';
    } elseif (!preg_match(RX_NAME, $fullname)) {
        $errors['fullname'] = 'Names must be 2-60 characters: letters, spaces, hyphens, apostrophes and dots only.';
    }

    // ---- Email ----
    if ($email === '') {
        $errors['email'] = 'Please enter your email address.';
    } elseif (!preg_match(RX_EMAIL, $email)) {
        $errors['email'] = "That doesn't look like a valid email (try name@example.com).";
    } elseif (find_user_by_email($email)) {
        $errors['email'] = 'That email is already registered. Try logging in instead.';
    }

    // ---- Password ----
    if ($password === '') {
        $errors['password'] = 'Please create a password.';
    } elseif (!preg_match(RX_PASSWORD, $password)) {
        $errors['password'] = 'Password needs at least 6 characters with one letter and one number.';
    }

    // ---- Confirm password ----
    if ($confirm === '') {
        $errors['confirm-password'] = 'Please confirm your password.';
    } elseif ($password !== $confirm) {
        $errors['confirm-password'] = "Passwords don't match. Please type the same password again.";
    }

    // ---- Save the account ----
    if (!$errors) {
        $users   = get_users();
        $users[] = [
            'name'     => $fullname,
            'email'    => strtolower($email),
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];
        save_users($users);

        $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Account created! You can now sign in.'];
        header('Location: login.php');
        exit;
    }
}

// Helpers for re-rendering the form
function field_class($errors, $name, $submitted) {
    if (isset($errors[$name])) return 'input-error';
    return $submitted ? 'input-ok' : '';
}
function field_error($errors, $name) {
    return isset($errors[$name]) ? '<span class="error-msg">' . e($errors[$name]) . '</span>' : '';
}
$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';

$pageTitle  = 'Create account - Stellar';
$bodyClass  = 'auth-page';
$skyHeading = 'Your seat on the observatory deck.';
$skyText    = 'Create a free account to open the guide to galaxies and the solar system.';

include 'includes/header.php';
?>
    <main class="split">

<?php include 'includes/auth_sky.php'; ?>

        <section class="panel">
            <div class="form-wrap">
                <span class="eyebrow">New explorer</span>
                <h1>Create your account</h1>
                <p class="lead">It takes less than a minute.</p>

                <?php if ($errors): ?>
                <div id="formAlert" class="form-alert error" role="alert" aria-live="polite">Please fix the highlighted fields and try again.</div>
                <?php endif; ?>

                <form id="registerForm" action="register.php" method="POST" class="auth-form" novalidate>
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" autocomplete="name" value="<?= e($fullname) ?>" class="<?= field_class($errors, 'fullname', $submitted) ?>" required>
                        <?= field_error($errors, 'fullname') ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" autocomplete="email" value="<?= e($email) ?>" class="<?= field_class($errors, 'email', $submitted) ?>" required>
                        <?= field_error($errors, 'email') ?>
                    </div>

                    <div class="form-group">
                        <label for="reg-password">Password</label>
                        <input type="password" id="reg-password" name="password" placeholder="Create a password" autocomplete="new-password" class="<?= field_class($errors, 'password', $submitted) ?>" required>
                        <?= field_error($errors, 'password') ?>
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" autocomplete="new-password" class="<?= field_class($errors, 'confirm-password', $submitted) ?>" required>
                        <?= field_error($errors, 'confirm-password') ?>
                    </div>

                    <button type="submit" class="submit-btn">Create account</button>
                </form>

                <p class="switch">Already registered? <a href="login.php">Sign in</a></p>
            </div>
        </section>

    </main>

<?php include 'includes/scripts.php'; ?>

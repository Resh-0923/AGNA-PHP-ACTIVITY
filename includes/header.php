<?php
$pageTitle = $pageTitle ?? 'Stellar';
$bodyClass = $bodyClass ?? 'home-page';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="description" content="Stellar - a simple guide to the universe, galaxies and the solar system.">
    <meta name="theme-color" content="#090612">
    <title><?= e($pageTitle) ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body class="<?= e($bodyClass) ?>">

<?php if ($bodyClass === 'home-page'): ?>
    <!-- Mobile top bar -->
    <div class="topbar">
        <a class="brand" href="#top"><span class="dot" aria-hidden="true"></span>Stellar</a>
        <button class="menu-btn" id="menuBtn" type="button" aria-label="Open menu" aria-controls="sidebar" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </div>
<?php endif; ?>

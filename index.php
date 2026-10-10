<?php
require_once 'includes/config.php';
require_login();

$pageTitle = 'Welcome - Stellar';
$bodyClass = 'home-page';

include 'includes/header.php';
include 'includes/navigation.php';
?>

    <main class="content">

<?php include 'includes/hero.php'; ?>


<?php include 'includes/scale.php'; ?>


<?php include 'includes/galaxies.php'; ?>


<?php include 'includes/planets.php'; ?>


<?php include 'includes/footer.php'; ?>

    </main>

<?php include 'includes/scripts.php'; ?>

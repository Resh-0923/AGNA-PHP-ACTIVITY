<?php // Sidebar navigation + signed-in user box. ?>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <a class="brand" href="#top"><span class="dot" aria-hidden="true"></span>Stellar</a>

        <nav class="side-nav" aria-label="Sections">
            <a href="#top" data-section="top">Overview</a>
            <a href="#scale" data-section="scale">Scale of it all</a>
            <a href="#galaxies" data-section="galaxies">Galaxies</a>
            <a href="#planets" data-section="planets">Solar system</a>
        </nav>

        <div class="side-user">
            <div class="avatar" aria-hidden="true">★</div>
            <div class="who">
                <small>Signed in as</small>
                <strong class="js-user"><?= e($_SESSION['cosmos_user']) ?></strong>
            </div>
            <a href="logout.php" id="logoutBtn" class="logout">Log out</a>
        </div>
    </aside>

    <div class="scrim" id="scrim"></div>

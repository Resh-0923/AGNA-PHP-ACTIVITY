<?php
// Left-hand "sky" panel shared by login.php and register.php.
// Expects $skyHeading and $skyText from the including file.
?>
        <section class="sky">
            <canvas class="starfield" aria-hidden="true"></canvas>

            <a class="sky-brand" href="login.php"><span class="dot" aria-hidden="true"></span>Stellar</a>

            <div class="orbits" aria-hidden="true">
                <div class="orbit o3"><span class="planet"></span></div>
                <div class="orbit o2"><span class="planet"></span></div>
                <div class="orbit o1"><span class="planet"></span></div>
                <div class="sun"></div>
            </div>

            <div class="sky-copy">
                <h2><?= e($skyHeading) ?></h2>
                <p><?= e($skyText) ?></p>
            </div>
        </section>

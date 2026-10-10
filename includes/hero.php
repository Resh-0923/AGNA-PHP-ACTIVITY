<?php // Hero / overview section. ?>
        <!-- OVERVIEW -->
        <section id="top" class="hero">
            <canvas class="starfield" aria-hidden="true"></canvas>

            <div class="hero-inner">
                <p class="welcome" role="status">Welcome, <span id="welcomeName"><?= e($_SESSION['cosmos_user']) ?></span>!</p>

                <h1>The universe, <em>up close.</em></h1>

                <p class="hero-lead">
                    A simple tour of space, from the size of the universe to the galaxies and planets around us. Follow the sidebar from top to bottom.
                </p>

                <div class="hero-actions">
                    <a href="#galaxies" class="btn btn-primary">Explore galaxies</a>
                    <a href="#planets" class="btn btn-outline">Meet the planets</a>
                </div>
            </div>

            <div class="hero-orbits" aria-hidden="true">
                <div class="orbit o3"><span class="planet"></span></div>
                <div class="orbit o2"><span class="planet"></span></div>
                <div class="orbit o1"><span class="planet"></span></div>
                <div class="sun"></div>
            </div>
        </section>

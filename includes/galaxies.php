<?php // Galaxies section. ?>
        <!-- GALAXIES -->
        <section id="galaxies" class="block block-alt">
            <header class="block-head">
                <p class="kicker">Galaxies</p>
                <h2>Islands of stars</h2>
                <p>A galaxy is a huge system of stars, gas, dust and dark matter held together by gravity. The observable universe holds hundreds of billions of them, possibly trillions. Pick a type to compare.</p>
            </header>

            <div class="tabs" role="tablist" aria-label="Galaxy types">
                <button class="tab active" role="tab" aria-selected="true"  data-galaxy="spiral">Spiral</button>
                <button class="tab"        role="tab" aria-selected="false" data-galaxy="elliptical">Elliptical</button>
                <button class="tab"        role="tab" aria-selected="false" data-galaxy="lenticular">Lenticular</button>
                <button class="tab"        role="tab" aria-selected="false" data-galaxy="irregular">Irregular</button>
            </div>

            <div class="galaxy-panel" id="galaxyPanel">
                <div class="galaxy-art g-spiral" id="galaxyArt" aria-hidden="true"></div>
                <div class="galaxy-text">
                    <h3 id="galaxyName">Spiral galaxies</h3>
                    <p class="galaxy-meta" id="galaxyMeta">Flat discs with curving arms</p>
                    <p id="galaxyBody">
                        A bright central bulge sits inside a thin, rotating disc with arms where new stars are born. Many have a bar of stars through the middle. Our own Milky Way is a barred spiral.
                    </p>
                </div>
            </div>

            <div class="two-up">
                <article class="callout">
                    <h3>The Milky Way</h3>
                    <p>Home to somewhere between 100 and 400 billion stars. The Sun sits in one of the outer arms, about 26,000 light-years from the center, and takes roughly 230 million years to orbit it once.</p>
                </article>
                <article class="callout">
                    <h3>Andromeda</h3>
                    <p>The nearest large spiral, about 2.5 million light-years away. It is moving toward us, and the two galaxies are expected to merge in about 4 to 5 billion years.</p>
                </article>
            </div>
        </section>

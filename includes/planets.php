<?php
// Solar system section. Planet cards are built from this array.
$planets = [
    ['mercury', 'Mercury', 'Smallest planet',     'The closest planet to the Sun. It has almost no atmosphere, so days are scorching and nights are freezing.'],
    ['venus',   'Venus',   'Hottest planet',      'A thick carbon dioxide atmosphere traps heat, so the surface is hot enough to melt lead. It also spins backward compared with most planets.'],
    ['earth',   'Earth',   'Only known life',     'The only place we know has life. Liquid water covers most of its surface, and one large Moon helps steady its tilt.'],
    ['mars',    'Mars',    'The red planet',      'Home to Olympus Mons, the tallest volcano known in the solar system. Dry river beds show that water once flowed here.'],
    ['jupiter', 'Jupiter', 'Largest planet',      'A gas giant big enough to hold over a thousand Earths. Its Great Red Spot is a storm that has raged for centuries.'],
    ['saturn',  'Saturn',  'Famous rings',        'Its bright rings are made of ice and rock. Saturn is so light for its size that it would float in a big enough bath of water.'],
    ['uranus',  'Uranus',  'Tipped on its side',  'An ice giant that rolls around the Sun on its side, tilted about 98 degrees. It looks pale blue-green because of methane.'],
    ['neptune', 'Neptune', 'Windiest planet',     'The farthest planet, dark blue and cold. It has the fastest winds known in the solar system, faster than the speed of sound.'],
];
?>
        <!-- PLANETS -->
        <section id="planets" class="block">
            <header class="block-head">
                <p class="kicker">Solar system</p>
                <h2>Eight worlds, one star</h2>
                <p>Scroll sideways through the planets, from the one nearest the Sun to the farthest.</p>
            </header>

            <div class="planet-row" tabindex="0" aria-label="Planets, scroll horizontally">
<?php foreach ($planets as [$key, $name, $tag, $text]): ?>

                <article class="planet-card">
                    <div class="sphere p-<?= e($key) ?>" aria-hidden="true"></div>
                    <h3><?= e($name) ?></h3>
                    <p class="tag"><?= e($tag) ?></p>
                    <p><?= e($text) ?></p>
                </article>
<?php endforeach; ?>

            </div>
        </section>

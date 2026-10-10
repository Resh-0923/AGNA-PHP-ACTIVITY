/* Stellar front-end: starfield, sidebar, scroll spy, galaxy tabs.
   Login/registration are now handled on the server (login.php / register.php). */

/* Twinkling starfield for every <canvas class="starfield"> on the page.
   Each canvas fills its parent element. Stars hold still if the visitor
   prefers reduced motion. */

(function () {
    "use strict";

    var canvases = document.querySelectorAll("canvas.starfield");
    if (!canvases.length) { return; }

    var reduceMotion = window.matchMedia &&
        window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    var palette = ["#ffffff", "#cfe8ff", "#ffe9c7", "#d9ccff"];

    canvases.forEach(function (canvas) {
        var ctx = canvas.getContext("2d");
        var stars = [];
        var w = 0, h = 0, dpr = 1;

        function build() {
            var rect = canvas.parentElement.getBoundingClientRect();
            dpr = Math.min(window.devicePixelRatio || 1, 2);
            w = Math.max(rect.width, 1);
            h = Math.max(rect.height, 1);
            canvas.width = w * dpr;
            canvas.height = h * dpr;
            canvas.style.width = w + "px";
            canvas.style.height = h + "px";
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

            var count = Math.round((w * h) / 5500);
            stars = [];
            for (var i = 0; i < count; i++) {
                stars.push({
                    x: Math.random() * w,
                    y: Math.random() * h,
                    r: Math.random() * 1.3 + 0.25,
                    base: Math.random() * 0.6 + 0.25,
                    speed: Math.random() * 1.6 + 0.4,
                    phase: Math.random() * Math.PI * 2,
                    color: palette[Math.floor(Math.random() * palette.length)]
                });
            }
        }

        function draw(t) {
            ctx.clearRect(0, 0, w, h);
            for (var i = 0; i < stars.length; i++) {
                var s = stars[i];
                var a = reduceMotion
                    ? s.base
                    : s.base + Math.sin(t / 1000 * s.speed + s.phase) * 0.3;
                ctx.globalAlpha = Math.max(0.05, Math.min(1, a));
                ctx.fillStyle = s.color;
                ctx.beginPath();
                ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
                ctx.fill();
            }
            ctx.globalAlpha = 1;
            if (!reduceMotion) { requestAnimationFrame(draw); }
        }

        build();
        draw(0);
        if (!reduceMotion) { requestAnimationFrame(draw); }

        var timer;
        window.addEventListener("resize", function () {
            clearTimeout(timer);
            timer = setTimeout(function () {
                build();
                if (reduceMotion) { draw(0); }
            }, 150);
        });
    });
})();

/* Stellar landing page interactions: sidebar, scroll spy, galaxy tabs. */

(function ($) {
    "use strict";

    var $body = $("body");

    /* ---------- Mobile sidebar ---------- */

    function setMenu(open) {
        $body.toggleClass("nav-open", open);
        $("#menuBtn").attr("aria-expanded", open ? "true" : "false");
    }

    $("#menuBtn").on("click", function () {
        setMenu(!$body.hasClass("nav-open"));
    });

    $("#scrim").on("click", function () { setMenu(false); });
    $(".side-nav a").on("click", function () { setMenu(false); });

    $(document).on("keydown", function (e) {
        if (e.key === "Escape") { setMenu(false); }
    });

    /* ---------- Scroll spy: highlight the current section ---------- */

    var links = {};
    $(".side-nav a").each(function () {
        links[$(this).data("section")] = $(this);
    });

    if ("IntersectionObserver" in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    $(".side-nav a").removeClass("current");
                    var link = links[entry.target.id];
                    if (link) { link.addClass("current"); }
                }
            });
        }, { rootMargin: "-35% 0px -55% 0px" });

        Object.keys(links).forEach(function (id) {
            var el = document.getElementById(id);
            if (el) { observer.observe(el); }
        });
    }

    /* ---------- Galaxy types ---------- */

    var galaxies = {
        spiral: {
            name: "Spiral galaxies",
            meta: "Flat discs with curving arms",
            body: "A bright central bulge sits inside a thin, rotating disc with arms where new stars are born. Many have a bar of stars through the middle. Our own Milky Way is a barred spiral."
        },
        elliptical: {
            name: "Elliptical galaxies",
            meta: "Smooth, rounded balls of older stars",
            body: "These have little gas or dust, so very few new stars form. They range from small dwarfs to giants that hold trillions of stars, and they are mostly made of old, reddish stars."
        },
        lenticular: {
            name: "Lenticular galaxies",
            meta: "A disc with no visible arms",
            body: "Sitting between spirals and ellipticals, they have a bulge and a flat disc but few or no spiral arms and little star formation. Their name comes from their lens-like shape seen edge-on."
        },
        irregular: {
            name: "Irregular galaxies",
            meta: "No clear shape at all",
            body: "These lack any regular structure, often because of a close encounter or collision with another galaxy. Many are rich in gas and make new stars quickly. The Large Magellanic Cloud is a well-known neighbor."
        }
    };

    $(".tab").on("click", function () {
        var key = $(this).data("galaxy");
        var g = galaxies[key];
        if (!g) { return; }

        $(".tab").removeClass("active").attr("aria-selected", "false");
        $(this).addClass("active").attr("aria-selected", "true");

        $("#galaxyArt").attr("class", "galaxy-art g-" + key);
        $("#galaxyName").text(g.name);
        $("#galaxyMeta").text(g.meta);
        $("#galaxyBody").text(g.body);
    });

})(jQuery);


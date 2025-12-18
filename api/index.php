<?php
// Mock data with customized background images for each
$clubs = [
    [
        'id' => 'robotics',
        'name' => 'Robotics & AI',
        'category' => 'Technology',
        'description' => 'Pioneering the future through autonomous systems.',
        'image' => 'robotics_thumbnail.png',
        'hero_bg' => 'modern_university_building.png', // Default
        'hero_title' => 'ENGINEERING THE FUTURE'
    ],
    [
        'id' => 'arts',
        'name' => 'Aura Arts',
        'category' => 'Creative',
        'description' => 'A sanctuary for visual storytellers.',
        'image' => 'robotics_thumbnail.png',
        'hero_bg' => 'arts_bg.png',
        'hero_title' => 'UNLEASH YOUR CREATIVITY'
    ],
    [
        'id' => 'debate',
        'name' => 'Debate Society',
        'category' => 'Academic',
        'description' => 'Master the art of persuasion and discourse.',
        'image' => 'robotics_thumbnail.png',
        'hero_bg' => 'debate_bg.png',
        'hero_title' => 'VOICE OF THE STUDENTS'
    ],
    [
        'id' => 'eco',
        'name' => 'Eco Warriors',
        'category' => 'Social',
        'description' => 'Leading sustainable initiatives on campus.',
        'image' => 'robotics_thumbnail.png',
        'hero_bg' => 'eco_bg.png',
        'hero_title' => 'SUSTAINABLE TOMORROW'
    ],
    [
        'id' => 'music',
        'name' => 'Music Ensemble',
        'category' => 'Performance',
        'description' => 'Harmonizing digital production with orchestral brilliance.',
        'image' => 'robotics_thumbnail.png',
        'hero_bg' => 'music_bg.png',
        'hero_title' => 'RHYTHM OF THE NIGHT'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>After9 | Editorial Club Platform</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <div class="logo">After9</div>
        <nav>
            <ul>
                <li><a href="#" class="active">Discover</a></li>
                <li><a href="#">Events</a></li>
                <li><a href="#">Join Club</a></li>
                <li><a href="#">My Space</a></li>
                <li>
                    <div class="user-profile"></div>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="hero-left">
                <div class="filter-dropdown">
                    <span class="logo-font" style="font-size: 1.2rem;">All Categories</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </div>

                <div class="club-list">
                    <?php foreach ($clubs as $index => $club): ?>
                        <article class="club-card <?php echo $index === 0 ? 'active' : ''; ?>"
                            data-bg="<?php echo $club['hero_bg']; ?>" data-title="<?php echo $club['hero_title']; ?>">
                            <div class="club-card-img">
                                <img src="<?php echo $club['image']; ?>" alt="<?php echo $club['name']; ?>">
                            </div>
                            <div class="club-card-content">
                                <span class="category-pill"><?php echo $club['category']; ?></span>
                                <h3><?php echo $club['name']; ?></h3>
                                <p><?php echo $club['description']; ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="hero-right" id="hero-right-container">
                <!-- Dynamic Background Layers will be inserted here -->
                <div class="hero-bg-layer active" style="background-image: url('<?php echo $clubs[0]['hero_bg']; ?>');">
                </div>

                <div class="hero-right-overlay"></div>

                <div class="hero-text">
                    <p>Featured Highlight</p>
                    <h1 id="hero-title" class="show"><?php echo $clubs[0]['hero_title']; ?></h1>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.club-card');
            const heroContainer = document.getElementById('hero-right-container');
            const heroTitle = document.getElementById('hero-title');

            // Preload images
            const imageUrls = [<?php foreach ($clubs as $c)
                echo "'" . $c['hero_bg'] . "',"; ?>];
            imageUrls.forEach(url => {
                const img = new Image();
                img.src = url;
            });

            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    // Update Active State
                    cards.forEach(c => c.classList.remove('active'));
                    card.classList.add('active');

                    // Get Data
                    const newBg = card.getAttribute('data-bg');
                    const newTitle = card.getAttribute('data-title');

                    // 1. Create new BG Layer
                    const newLayer = document.createElement('div');
                    newLayer.className = 'hero-bg-layer';
                    newLayer.style.backgroundImage = `url('${newBg}')`;

                    // Insert before overlay
                    const overlay = heroContainer.querySelector('.hero-right-overlay');
                    heroContainer.insertBefore(newLayer, overlay);

                    // Trigger transition
                    requestAnimationFrame(() => {
                        newLayer.classList.add('active');

                        // Fade out old layers
                        const oldLayers = heroContainer.querySelectorAll('.hero-bg-layer:not(:last-of-type)');
                        oldLayers.forEach(layer => {
                            layer.classList.remove('active');
                            setTimeout(() => {
                                if (layer.parentNode) layer.parentNode.removeChild(layer);
                            }, 800); // Match CSS duration
                        });
                    });

                    // 2. Animate Title
                    heroTitle.classList.remove('show');
                    setTimeout(() => {
                        heroTitle.textContent = newTitle;
                        heroTitle.classList.add('show');
                    }, 300);
                });
            });
        });
    </script>
</body>

</html>
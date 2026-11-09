<?php
declare(strict_types=1);
require_once __DIR__ . '/config/config.php';
include __DIR__ . '/includes/header.php';

$success = $_SESSION['success'] ?? null;
$error   = $_SESSION['error'] ?? null;
unset($_SESSION['success'], $_SESSION['error']);

$features = [
    ['◌', 'Play with purpose', 'Open-ended play, sensory exploration, and hands-on materials that build fine motor, language, and problem-solving skills — all disguised as fun.'],
    ['✦', 'Follow their curiosity', 'Educators observe what each child is drawn to and shape activities around it, instead of pushing every child through the same worksheet.'],
    ['♡', 'Grow as a community', 'Mixed-age moments, family events, and daily hand-offs with parents keep everyone — kids, educators, and families — genuinely connected.'],
];
$programs = [
    ['6 weeks – 18 months', 'Infant Care', "Responsive, one-on-one caregiving built around each baby's own rhythm for eating, sleeping, and play."],
    ['18 – 36 months', 'Toddler Program', 'Language-rich routines, early independence, and lots of movement as toddlers test what their bodies and words can do.'],
    ['3 – 4 years', 'Preschool', 'Structured exploration of letters, numbers, and the natural world through projects children help choose.'],
    ['4 – 5 years', 'Kindergarten', 'School-readiness with a focus on confidence, collaboration, and independent thinking before day one.'],
    ['5 – 12 years', 'Out-of-School Care', 'Before and after school care with homework support, active play, and clubs that make the school year easier on families.'],
];
$day = [
    ['6:30 AM', 'Welcome & free play', 'Doors open, children settle in with quiet activities as they arrive.'],
    ['9:00 AM', 'Morning exploration', 'Guided learning activities — art, science, story, and movement — rotate through small groups.'],
    ['11:30 AM', 'Lunch & rest', 'A home-cooked meal followed by quiet time or nap, depending on age.'],
    ['2:00 PM', 'Outdoor time', 'Fresh air, gross motor play, and nature-based exploration in our outdoor space.'],
    ['4:00 PM', 'Afternoon activities & pickup', 'Snack, wind-down activities, and a personal hand-off to parents at the end of the day.'],
];
?>
<main id="top">

<section class="hero">
    <div class="container hero-grid">
        <div class="hero-content">
            <span class="eyebrow">Early Learning &amp; Child Care</span>
            <h1>Curious minds <span>start the day here.</span></h1>
            <p class="hero-text">NoName Daycare blends play, nature, and hands-on discovery into every day — for children from six weeks through school age. Licensed educators, small groups, and a program built around how young children actually learn.</p>
            <div class="hero-buttons">
                <a href="#tour" class="button button-primary">Schedule a Visit</a>
                <a href="#programs" class="button button-secondary">See Our Programs</a>
            </div>
        </div>
        <div class="hero-card" aria-hidden="true">
            <div class="hero-card-shape">✦</div>
            <div class="hero-note"><strong>Little hands.</strong><br>Big discoveries.</div>
        </div>
    </div>
</section>

<section class="stats">
    <div class="container stats-grid">
        <div><strong>6 wks–12 yrs</strong><span>Ages served</span></div>
        <div><strong>6:30–6:00</strong><span>Daily hours</span></div>
        <div><strong>100%</strong><span>Certified educators</span></div>
        <div><strong>Small</strong><span>Group sizes</span></div>
    </div>
</section>

<section class="section philosophy" id="philosophy">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Our philosophy</span>
            <h2>Learning through exploration</h2>
            <p>We build each day around a simple idea: children learn best when they're free to investigate, ask questions, and follow their own curiosity — supported, not directed, by the adults around them.</p>
        </div>
        <div class="feature-grid">
            <?php foreach ($features as [$icon, $title, $text]): ?>
            <article class="feature-card">
                <div class="feature-icon"><?= $icon ?></div>
                <h3><?= e($title) ?></h3>
                <p><?= e($text) ?></p>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section programs" id="programs">
    <div class="container">
        <div class="section-heading centered">
            <span class="eyebrow">Programs by age</span>
            <h2>One roof, one philosophy</h2>
            <p>Programming shaped for every stage from early infancy to the after-school years.</p>
        </div>
        <div class="program-grid">
            <?php foreach ($programs as [$age, $title, $text]): ?>
            <article class="program-card">
                <span class="age"><?= e($age) ?></span>
                <h3><?= e($title) ?></h3>
                <p><?= e($text) ?></p>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section day-section" id="day">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">A day at NoName Daycare</span>
            <h2>A rhythm built for little learners</h2>
            <p>Every classroom has its own pace, but the shape of the day looks something like this.</p>
        </div>
        <div class="timeline">
            <?php foreach ($day as [$time, $title, $text]): ?>
            <div class="timeline-item">
                <time><?= e($time) ?></time>
                <div><h3><?= e($title) ?></h3><p><?= e($text) ?></p></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="testimonial">
    <div class="container">
        <div class="quote-mark">“</div>
        <blockquote>Our daughter runs in every morning now. The staff know her by name, and I actually hear about her day instead of getting a one-word answer.</blockquote>
        <cite>— A NoName Daycare parent</cite>
    </div>
</section>

<section class="section tour-section" id="tour">
    <div class="container tour-grid">
        <div>
            <span class="eyebrow">Come see it for yourself</span>
            <h2>Let's get to know your family.</h2>
            <p>Book a tour or send us a question — we'll get back to you within one business day.</p>
            <div class="contact-details">
                <div><strong>Location</strong><p><?= e(DAYCARE_ADDRESS) ?></p></div>
                <div><strong>Hours</strong><p>Monday – Friday<br>6:30 AM – 6:00 PM</p></div>
                <div><strong>Email</strong><p><?= e(DAYCARE_EMAIL) ?></p></div>
                <div><strong>Phone</strong><p><?= e(DAYCARE_PHONE) ?></p></div>
            </div>
        </div>

        <div class="form-card">
            <?php if ($success): ?><div class="alert success" role="alert"><?= e($success) ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert error" role="alert"><?= e($error) ?></div><?php endif; ?>

            <form action="submit.php" method="POST" id="tourForm">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <div class="honeypot" aria-hidden="true">
                    <label for="website">Website</label>
                    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="parent_name">Parent name *</label>
                    <input type="text" id="parent_name" name="parent_name" placeholder="Jane Smith" required maxlength="150" autocomplete="name">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="child_age">Child's age *</label>
                        <input type="text" id="child_age" name="child_age" placeholder="e.g. 2 years" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" placeholder="(000) 000-0000" maxlength="50" autocomplete="tel">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required maxlength="255" autocomplete="email">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="preferred_date">Preferred tour date</label>
                        <input type="date" id="preferred_date" name="preferred_date">
                    </div>
                    <div class="form-group">
                        <label for="preferred_time">Preferred time</label>
                        <select id="preferred_time" name="preferred_time">
                            <option value="">Select a time</option>
                            <option>Morning</option>
                            <option>Midday</option>
                            <option>Afternoon</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" rows="5" maxlength="3000" placeholder="Tell us what you're looking for..." required></textarea>
                    <div class="character-count" id="characterCount">0 / 3000</div>
                </div>
                <button type="submit" class="button button-primary button-full" id="submitButton">Request a Tour</button>
                <p class="privacy-note">By submitting this form, you agree that NoName Daycare may contact you about your inquiry.</p>
            </form>
        </div>
    </div>
</section>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>

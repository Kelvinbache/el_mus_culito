<?php 

$PATH = "./../";

require_once __DIR__ . $PATH .  "headers/header.php"; 
require_once __DIR__ . $PATH . "nav/nav.php";

?>

<main class="content-wrapper">
        <section class="hero container">
            <div class="hero-bg-text">MUSCULO</div>
            <div class="hero-grid">
                <div></div>
                <div class="hero-content">
                    <div class="badge">
                        <span class="dot"></span>
                        <span class="badge-text">Powering 500+ Elite Gyms</span>
                    </div>
                    <div class="hero-titles">
                        <h1 class="main-title">
                            El Mus-culito <br/>
                            <span class="text-primary">Dominance</span>
                        </h1>
                        <p class="hero-description">
                            Stop managing, start leading. The ultimate command center for gym owners who demand explosive growth and flawless operations.
                        </p>
                    </div>
                    <div class="hero-btns">
                        <button class="btn-cta">Claim Your Trial</button>
                        <button class="btn-secondary">
                            <span class="material-symbols-outlined">play_arrow</span>
                            The Tour
                        </button>
                    </div>
                </div>

                <div class="hero-visual">
                    <div class="visual-glow"></div>
                    <div class="visual-card" style='background-image: url("https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1000&auto=format&fit=crop");'>
                        <div class="card-overlay"></div>
                        <div class="stat-badge">
                            <span class="stat-label">Active Members</span>
                            <span class="stat-value">12,408</span>
                        </div>
                        <div class="card-footer glass-nav">
                            <div class="footer-stat">
                                <span class="footer-label">Revenue Velocity</span>
                                <span class="footer-value">+42%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="stats container">
            <div class="stats-grid">
                <div class="stat-item">
                    <p class="stat-category">Retention</p>
                    <p class="stat-number">98.2%</p>
                </div>
                <div class="stat-item">
                    <p class="stat-category">Setup Time</p>
                    <p class="stat-number">5 Min</p>
                </div>
                <div class="stat-item">
                    <p class="stat-category">Growth Avg</p>
                    <p class="stat-number">3.5X</p>
                </div>
                <div class="stat-item">
                    <p class="stat-category">Support</p>
                    <p class="stat-number">24/7</p>
                </div>
            </div>
        </section>

        <section class="features container">
            <div class="section-header">
                <h2 class="sub-label">Engineered for Iron</h2>
                <h3 class="section-title">Built for those who <br><span class="text-stroke">never settle.</span></h3>
            </div>
            <div class="features-grid">
                <div class="feature-card group">
                    <div class="feature-icon">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <h4>Ironclad Billing</h4>
                    <p>Zero-leakage automated payments. We handle the recovery so you can focus on the reps.</p>
                </div>
                <div class="feature-card group">
                    <div class="feature-icon">
                        <span class="material-symbols-outlined">monitoring</span>
                    </div>
                    <h4>Elite Analytics</h4>
                    <p>Deep-dive performance metrics. Track churn, LTV, and peak hours with surgical precision.</p>
                </div>
                <div class="feature-card group">
                    <div class="feature-icon">
                        <span class="material-symbols-outlined">groups</span>
                    </div>
                    <h4>Tribe Management</h4>
                    <p>Community building tools designed for high-engagement fitness brands. Keep members hooked.</p>
                </div>
            </div>
        </section>

        <section class="final-cta container">
            <div class="cta-box">
                <div class="cta-watermark">
                    <span class="material-symbols-outlined">fitness_center</span>
                </div>
                <div class="cta-content">
                    <h2 class="cta-title">Build Your <br> Empire Now</h2>
                    <p class="cta-text">The difference between a local gym and a global brand is the system behind it.</p>
                    <div class="cta-btns">
                        <button class="btn-dark">Start Free Dominance</button>
                        <button class="btn-outline-dark">Talk to Experts</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require_once __DIR__ . $PATH . "footers/footer_of_home.php" ?>
  
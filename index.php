<?php 
include 'includes/db.php';
include 'includes/header.php'; 

// Fetch Stats
$employers_q = $conn->query("SELECT COUNT(*) as count FROM employers");
$total_employers = $employers_q->fetch_assoc()['count'];

$candidates_q = $conn->query("SELECT COUNT(*) as count FROM candidates");
$total_candidates = $candidates_q->fetch_assoc()['count'];

// Estimated/Static stats for "Jobs Posted" and "Placed" as we don't have this granular data yet
$jobs_posted = ($total_employers > 0) ? $total_employers * 3 + 150 : 150; 
$placed_candidates = 850 + ($total_employers * 2); // Dynamic-ish
?>

<div class="hero">
    <h1>Find Your Dream Job Today</h1>
    <p>Connecting verified candidates with top-tier employers. Join thousands of success stories.</p>
    <div style="display: flex; gap: 1rem; justify-content: center;">
        <a href="candidate_form.php" class="btn btn-primary">I'm a Candidate</a>
        <a href="employer_form.php" class="btn btn-outline">I'm an Employer</a>
    </div>
</div>

<!-- Company Carousel -->
<div class="carousel-container">
    <div class="carousel-track">
        <!-- Duplicate items for seamless scroll -->
        <?php 
        $companies = ["Google", "Microsoft", "Amazon", "Tesla", "Netflix", "Meta", "Adobe", "Spotify", "Uber", "Airbnb", "Google", "Microsoft", "Amazon", "Tesla", "Netflix", "Meta", "Adobe", "Spotify", "Uber", "Airbnb"];
        foreach($companies as $company): 
        ?>
        <div class="carousel-item"><?php echo $company; ?></div>
        <?php endforeach; ?>
    </div>
</div>

<div class="container">
    
    <!-- Statistics Section -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-number"><?php echo $jobs_posted; ?>+</div>
            <div class="stat-label">Jobs Posted</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo $placed_candidates; ?>+</div>
            <div class="stat-label">Candidates Hired</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo $total_candidates; ?></div>
            <div class="stat-label">Candidates on Portal</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">50+</div>
            <div class="stat-label">Cities Covered</div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="row" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 2rem;">
        <div class="glass-card">
            <h3 style="color: var(--primary-color); margin-bottom: 1rem;">For Candidates</h3>
            <p style="color: var(--text-muted);">Get access to exclusive job openings from top companies. Build your profile and get noticed.</p>
        </div>
        <div class="glass-card">
            <h3 style="color: var(--secondary-color); margin-bottom: 1rem;">For Employers</h3>
            <p style="color: var(--text-muted);">Find the perfect match for your company culture and requirements. Browse verified talent.</p>
        </div>
        <div class="glass-card">
            <h3 style="color: var(--accent-color); margin-bottom: 1rem;">Success Stories</h3>
            <p style="color: var(--text-muted);">See how we've helped thousands of professionals land their dream careers.</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

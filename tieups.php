<?php include 'includes/header.php'; ?>

<div class="container" style="padding-top: 2rem;">
    <h1 style="color: var(--primary-color); margin-bottom: 2rem; text-align: center;">Our Corporate Tie-ups</h1>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.5rem;">
        <?php
        $companies = ["TechCorp Global", "Innovate Systems", "Future Soft", "Alpha Solutions", "Omega Dynamics", "Green Energy Co", "FinTech Giants", "HealthPlus"];
        foreach($companies as $company):
        ?>
        <div class="glass-card" style="display: flex; align-items: center; justify-content: center; height: 150px; text-align: center; margin-bottom: 0;">
            <h3 style="color: var(--text-color);"><?php echo $company; ?></h3>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

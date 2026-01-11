<?php include 'includes/header.php'; ?>

<div class="container" style="padding-top: 2rem;">
    <h1 style="color: var(--primary-color); margin-bottom: 2rem; text-align: center;">Recently Placed Candidates</h1>
    
    <div class="glass-card">
        <table style="width: 100%; border-collapse: collapse; color: var(--text-muted);">
            <thead>
                <tr style="border-bottom: 1px solid var(--glass-border); text-align: left;">
                    <th style="padding: 1rem;">Candidate Name</th>
                    <th style="padding: 1rem;">Company</th>
                    <th style="padding: 1rem;">Designation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $placements = [
                    ["John Doe", "TechCorp Global", "Senior Developer"],
                    ["Jane Smith", "Alpha Solutions", "UX Designer"],
                    ["Robert Wilson", "Future Soft", "Project Manager"],
                    ["Alice Brown", "Green Energy Co", "Data Analyst"],
                    ["Charlie Davis", "FinTech Giants", "Security Specialist"]
                ];
                foreach($placements as $p):
                ?>
                <tr style="border-bottom: 1px solid var(--glass-border);">
                    <td style="padding: 1rem; color: var(--text-color); font-weight: 500;"><?php echo $p[0]; ?></td>
                    <td style="padding: 1rem;"><?php echo $p[1]; ?></td>
                    <td style="padding: 1rem;"><?php echo $p[2]; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

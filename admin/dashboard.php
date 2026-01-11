<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

// Fetch stats
$employer_count = $conn->query("SELECT COUNT(*) as count FROM employers")->fetch_assoc()['count'];
$candidate_count = $conn->query("SELECT COUNT(*) as count FROM candidates")->fetch_assoc()['count'];

// Fetch recent employers
$employers = $conn->query("SELECT * FROM employers ORDER BY created_at DESC LIMIT 10");

// Fetch recent candidates
$candidates = $conn->query("SELECT * FROM candidates ORDER BY created_at DESC LIMIT 10");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Job Classified</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            text-align: left;
            padding: 1rem;
            border-bottom: 1px solid var(--glass-border);
        }
        th {
            color: var(--secondary-color);
        }
    </style>
</head>
<body>

<header style="background: rgba(15, 23, 42, 0.9);">
    <div class="container">
        <nav>
            <a href="dashboard.php" class="logo">Admin<span style="color: var(--secondary-color);">Panel</span></a>
            <div style="display: flex; gap: 1rem; align-items: center;">
                <span style="color: var(--text-muted);">Welcome, <?php echo $_SESSION['admin_username']; ?></span>
                <a href="logout.php" class="btn btn-outline" style="padding: 0.5rem 1rem;">Logout</a>
            </div>
        </nav>
    </div>
</header>

<main class="container">
    <h1 style="margin-bottom: 2rem;">Dashboard Overview</h1>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
        <div class="glass-card" style="text-align: center; border-color: var(--primary-color);">
            <h2 style="font-size: 3rem; color: var(--primary-color);"><?php echo $employer_count; ?></h2>
            <p style="color: var(--text-muted);">Total Employers</p>
        </div>
        <div class="glass-card" style="text-align: center; border-color: var(--secondary-color);">
            <h2 style="font-size: 3rem; color: var(--secondary-color);"><?php echo $candidate_count; ?></h2>
            <p style="color: var(--text-muted);">Total Candidates</p>
        </div>
    </div>

    <div class="glass-card">
        <h2 style="color: var(--primary-color); margin-bottom: 1rem;">Recent Employer Inquiries</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Requirements</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $employers->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['company_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo substr(htmlspecialchars($row['requirements']), 0, 50) . '...'; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="glass-card">
        <h2 style="color: var(--secondary-color); margin-bottom: 1rem;">Recent Candidate Registrations</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Skills</th>
                        <th>Resume</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $candidates->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['skills']); ?></td>
                        <td>
                            <?php if($row['resume_path']): ?>
                                <a href="../<?php echo $row['resume_path']; ?>" target="_blank" style="color: var(--accent-color);">View Resume</a>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

</body>
</html>

<?php 
include 'includes/db.php';
include 'includes/header.php'; 

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $conn->real_escape_string($_POST['company_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $requirements = $conn->real_escape_string($_POST['requirements']);

    $sql = "INSERT INTO employers (company_name, email, phone, requirements) VALUES ('$company_name', '$email', '$phone', '$requirements')";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='glass-card' style='border-color: #2dd4bf; color: #2dd4bf; padding: 1rem; text-align: center; margin-bottom: 2rem;'>Requirement submitted successfully! We will contact you soon.</div>";
    } else {
        $message = "<div class='glass-card' style='border-color: #f87171; color: #f87171; padding: 1rem; text-align: center; margin-bottom: 2rem;'>Error: " . $conn->error . "</div>";
    }
}
?>

<div class="container" style="padding-top: 2rem;">
    <div class="glass-card" style="max-width: 600px; margin: 0 auto;">
        <h1 style="color: var(--primary-color); text-align: center; margin-bottom: 2rem;">Employer Requirement Form</h1>
        <?php echo $message; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" id="company_name" name="company_name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Official Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            
            <div class="form-group">
                <label for="requirements">Job Requirements (Skills, Experience, Location etc.)</label>
                <textarea id="requirements" name="requirements" rows="5" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Requirement</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

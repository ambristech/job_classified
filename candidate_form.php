<?php 
include 'includes/db.php';
include 'includes/header.php'; 

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $skills = $conn->real_escape_string($_POST['skills']);
    
    // File Upload Logic
    $resume_path = "";
    if(isset($_FILES['resume']) && $_FILES['resume']['error'] == 0){
        $target_dir = "uploads/";
        $filename = time() . "_" . basename($_FILES["resume"]["name"]);
        $target_file = $target_dir . $filename;
        if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
            $resume_path = $target_file;
        } else {
            $message = "Error uploading file.";
        }
    }

    if ($message == "") {
        $sql = "INSERT INTO candidates (name, email, phone, skills, resume_path) VALUES ('$name', '$email', '$phone', '$skills', '$resume_path')";

        if ($conn->query($sql) === TRUE) {
            $message = "<div class='glass-card' style='border-color: #2dd4bf; color: #2dd4bf; padding: 1rem; text-align: center; margin-bottom: 2rem;'>Profile submitted successfully! Best of luck.</div>";
        } else {
            $message = "<div class='glass-card' style='border-color: #f87171; color: #f87171; padding: 1rem; text-align: center; margin-bottom: 2rem;'>Error: " . $conn->error . "</div>";
        }
    } else {
         $message = "<div class='glass-card' style='border-color: #f87171; color: #f87171; padding: 1rem; text-align: center; margin-bottom: 2rem;'>" . $message . "</div>";
    }
}
?>

<div class="container" style="padding-top: 2rem;">
    <div class="glass-card" style="max-width: 600px; margin: 0 auto;">
        <h1 style="color: var(--secondary-color); text-align: center; margin-bottom: 2rem;">Candidate Registration</h1>
        <?php echo $message; ?>
        
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            
            <div class="form-group">
                <label for="skills">Skills (e.g., PHP, Java, Python)</label>
                <input type="text" id="skills" name="skills" required>
            </div>

            <div class="form-group">
                <label for="resume">Upload Resume (PDF/Doc)</label>
                <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));">Submit Profile</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

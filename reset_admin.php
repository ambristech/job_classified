<?php
require_once 'includes/db.php';

$username = 'admin';
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

// Check if admin exists
$check = $conn->query("SELECT * FROM admins WHERE username = '$username'");

if ($check->num_rows > 0) {
    // Update existing
    $sql = "UPDATE admins SET password_hash = '$hash' WHERE username = '$username'";
    if ($conn->query($sql)) {
        echo "Password updated successfully for user '$username'.\n";
        echo "New Hash: " . $hash . "\n";
    } else {
        echo "Error updating password: " . $conn->error . "\n";
    }
} else {
    // Create new
    $sql = "INSERT INTO admins (username, password_hash) VALUES ('$username', '$hash')";
    if ($conn->query($sql)) {
        echo "Admin user created successfully.\n";
    } else {
        echo "Error creating admin: " . $conn->error . "\n";
    }
}

// Verification verify
$test_verify = password_verify($password, $hash);
echo "Verification Test: " . ($test_verify ? "PASS" : "FAIL") . "\n";

$conn->close();
?>

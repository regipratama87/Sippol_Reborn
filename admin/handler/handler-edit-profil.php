<?php
// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    require_once "../../koneksi.php";
    
    // Retrieve form data
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Perform update query
    $query = "UPDATE admin SET nama = '$nama', username = '$username', password = '$hashed_password' ";
    $result = mysqli_query($koneksi, $query);
    
    // Check if the query was successful
    if ($result) {
        // Set success message
        $_SESSION['success_message_admin'] = "Profil berhasil diperbarui.";
    } else {
        // Set error message
        $_SESSION['error_message_admin'] = "Gagal memperbarui profil. Silakan coba lagi.";
    }
    
    // Close the database connection
    mysqli_close($koneksi);
} else {
    // If the form is not submitted, set error message and redirect to index.php or any other page
    $_SESSION['error_message_admin'] = "Permintaan tidak valid. Silakan coba lagi.";
}

// Redirect back to the previous page
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>

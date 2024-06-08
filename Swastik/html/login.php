<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "userdb";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$login_message = "";

// User Authentication
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 1) {
        // Login successful
        session_start();
        $_SESSION['email'] = $email;
        echo "<script>
                    alert('Login successful!');
                    window.location.href = 'index.html';
                  </script>";
        } else {
            // Incorrect password
            echo "Invalid email or password";
        }
    } else {
        // User not found
        echo "Invalid email or password";
    }

mysqli_close($conn);
?>
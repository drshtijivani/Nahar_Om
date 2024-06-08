<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "userdb";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// User Registration
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $skills = $_POST['skills'];

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, gender, skills) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $password, $gender, $skills);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>
                    alert('Register successful!');
                    window.location.href = 'index.html';
                  </script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
mysqli_close($conn);
?>

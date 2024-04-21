<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "lunnatic02";
    $dbname = "bank";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    // Execute the statement
    if ($stmt->execute()) {
        // Registration successful
        echo "<script>alert('Registration successful! Redirecting to login page...'); window.location.href = 'login.html';</script>";
    } else {
        // Registration failed
        echo "<script>alert('Registration failed. Please try again later.');</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<?php
session_start();

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
    $password = $_POST["password"];

    // Prepare SQL statement to retrieve user
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows == 1) {
        // Fetch user data
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        // Compare passwords
        if ($password == $storedPassword) {
            // Password is correct, set session variable
            $_SESSION["username"] = $username;
            
            // Redirect to dashboard
            header("Location: dashboard.html");
            exit();
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect password. Please try again.');</script>";
        }
    } else {
        // User not found
        echo "<script>alert('User not found. Please register an account.');</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

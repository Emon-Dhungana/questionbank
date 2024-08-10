<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to your database
    $con = mysqli_connect('localhost', 'root', '', 'signup');

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    // Retrieve username and password from the form
    $username = $_POST['first'];
    $password = $_POST['password'];

    // Prepare a SQL query to fetch user data based on username and password
    $query = "SELECT * FROM demo WHERE uname = '$username' AND upassword = '$password'";

    // Execute the query
    $result = mysqli_query($con, $query);

    // Check if the query executed successfully
    if ($result) {
        // Check if the user exists
        if (mysqli_num_rows($result) == 1) {
            // User found, set session variable with username
            $_SESSION['username'] = $username;

            // Redirect to welcome page or display a success message
            echo "Login successful.";
        } else {
            // Invalid credentials, display error message
            echo "Invalid username or password";
        }
    } else {
        // Error executing query, display error message
        echo "Error: " . mysqli_error($con);
    }

    // Close the connection
    mysqli_close($con);
}
?>

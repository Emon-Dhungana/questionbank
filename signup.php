<?php
    $con = mysqli_connect('localhost', 'root', '', 'signup');
    $fullname = $_POST['fullname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $upassword = $_POST['upassword'];
    $query = "INSERT INTO demo (fullname, uname, email, upassword) VALUES ('$fullname', '$uname', '$email', '$upassword')";
    $run = mysqli_query($con, $query);
    if ($run) {
        // Display message and delay redirection for 2 seconds
        echo '<h1 style="color:green;">Registration successful.<br></h1><p style="color:green;font-size:20px"> Redirecting to Login Page...</p>';
        echo '<script>
                setTimeout(function() {
                    window.location.href = "login.html";
                }, 2000);
             </script>';
    } else {
        // Error message
        echo '<h1 style="color:red;">Error</h1>';
    }

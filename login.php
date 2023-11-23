<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $userPassword = $_POST["password"];

    //database connection login
    $servername = "localhost:3306";
    $username = "Alpha";
    $dbPassword = "Capstone";
    $dbname = "MoffatBay";

    //Connection attempt
    $conn = mysqli_connect($servername, $username, $dbPassword, $dbname);

    //Connection error
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //query password
    $query = "SELECT Password FROM Customer WHERE Email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);

    //Execute/bind/fetch query
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hashedPassword);
    mysqli_stmt_fetch($stmt);

    if (password_verify($userPassword, $hashedPassword)) {

        //When pass is correct, store email in current session.
        $_SESSION['email'] = $email;

        
        echo "success"; //Success message
       
        exit();

    } else {

        //Echo error message on unsuccessful login attempt.
        $loginError = "Invalid email or password. Please try again.";
        echo $loginError;
        exit();
    }

    //Close connection and statement.
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}


?>
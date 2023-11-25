<?php
/* 
Team Alpha
Sean Christman, Kadar Gayle, Rachel Nelson, Elijah Wilkinson */
$servername = "localhost:3306";
$username = "Alpha";
$password = "Capstone";
$dbname = "MoffatBay";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO customer (email, FirstName, LastName, Telephone, Password, StreetAddress, State, City, Zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $email, $fname, $lname, $phone, $hashed_password, $address, $state, $city, $zip);

// Set parameters and execute
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$password = $_POST["password"];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$address = $_POST["address"];
$state = $_POST["state"];
$city = $_POST["city"];
$zip = $_POST["zip"];
$stmt->execute();

header('Location: login.html');
exit;

$stmt->close();
$conn->close();
?>
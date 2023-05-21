<?php
$FirstName = $_POST['fname'];
$LastName = $_POST['lname'];
$Username = $_POST['Username'];
$Gender = $_POST['Gender'];
$Age = $_POST['Age'];
$Institution = $_POST['Institution'];
$Password = $_POST['Password'];

// Handling file upload named as dp

$img = file_get_contents($_FILES['dp']['tmp_name']);
$dp = $_FILES['dp']['name'];
$source = $_FILES['dp']['tmp_name'];
move_uploaded_file($source, "images/".$dp);

// DB Connection
$conn = new mysqli('localhost', 'root', '', 'phpform');

if ($conn->connect_error) {
    die('Connection Failed to Establish : ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("Insert into users(fname, lname, Age, Institution, Gender, Username, password, dp) values(?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssissssb", $FirstName, $LastName, $Age, $Institution, $Gender, $Username, $Password, $img);
    $stmt->send_long_data(7, $dp);
    $stmt->execute();
    echo "Registration Successful!!";
    $stmt->close();
    $conn->close();
}
?>
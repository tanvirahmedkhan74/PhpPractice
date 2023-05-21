<?php
$conn = new mysqli('localhost', 'root', '', 'phpform');
$result;

if ($conn->connect_error) {
    die('Connection Failed to Establish : ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="show.css">
    <title>Users</title>
</head>

<body>
    <div class="show_body">
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Username</th>
                    <th>Institution</th>
                    <th>Profile Picture</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($res = $result->fetch_assoc()) {
                    $fname = $res['fname'];
                    $lname = $res['lname'];
                    $age = $res['Age'];
                    $gender = $res['Gender'];
                    $username = $res['Username'];
                    $institution = $res['Institution'];
                    $dp = $res['dp'];

                    echo '<tr>';
                    echo '<td>' . $fname . '</td>';
                    echo '<td>' . $lname . '</td>';
                    echo '<td>' . $age . '</td>';
                    echo '<td>' . $gender . '</td>';
                    echo '<td>' . $username . '</td>';
                    echo '<td>' . $institution . '</td>';
                    echo "<td><img src='data:image/jpeg;base64," . base64_encode($dp) . "' alt='Profile Picture' width='100' height='100'></td>";
                    echo '</tr>';
                }
                ?>

            </tbody>
        </table>
    </div>
</body>

</html>';
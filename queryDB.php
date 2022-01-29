<?php
$servername = "localhost";
$username = "wordpress";
$password = "root";
$dbname = "wordpress";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT lat,lng FROM locations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $outarr = array();
    while($row = $result->fetch_assoc()) {
        $outarr[] = $row;
    }
    $json_output = json_encode($outarr);
} else {
    $json_output = json_encode(array());
}
$conn->close();
?>
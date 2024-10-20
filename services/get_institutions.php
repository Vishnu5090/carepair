<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "carepair";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Get the type of institution from the AJAX request
$type = $_GET['type'];

// Prepare the SQL statement based on the institution type
$sql = "SELECT institution, contact, email FROM institutions WHERE type = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $type);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the data and format it as JSON
$institutions = [];
while ($row = $result->fetch_assoc()) {
    $institutions[] = $row;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($institutions);

// Close the connection
$stmt->close();
$conn->close();
?>

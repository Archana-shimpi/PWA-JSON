<?php
session_start();
include('test_connection.php');

// Retrieve the JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Check if the data was successfully decoded
if (!empty($data['userName']) && !empty($data['passWord'])) {
    $username = $data['userName'];
    $password = $data['passWord'];

    // Query to check if username and password match in the database
    $query = "SELECT * FROM login WHERE user='$username' AND pass='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        // Login successful, set session
        $_SESSION['username'] = $username;
        echo json_encode(['success' => true, 'message' => 'Login successful!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password!']);
    }
} else {
    // If username or password is missing in the JSON data
    echo json_encode(['success' => false, 'message' => 'Please provide both username and password!']);
}
?>

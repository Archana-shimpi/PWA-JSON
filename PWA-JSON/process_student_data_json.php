<?php
include('test_connection.php');

// Retrieve JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['sr_no']) && !empty($data['name']) && !empty($data['class']) && !empty($data['grade'])) {
    $sr_no = $data['sr_no'];
    $name = $data['name'];
    $class = $data['class'];
    $grade = $data['grade'];

    // Insert the student data into the database
    $query = "INSERT INTO students (sr_no, name, class, grade) VALUES ('$sr_no', '$name', '$class', '$grade')";

    if (mysqli_query($con, $query)) {
        echo json_encode(['success' => true, 'message' => 'Student data added successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . mysqli_error($con)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Please provide all required fields!']);
}
?>

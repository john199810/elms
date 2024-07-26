<?php
session_start();

// Check if the user is logged in and is an Admin or Staff
if (!isset($_SESSION['username']) || (!in_array($_SESSION['userCategory'], ['Admin', 'Staff']))) {
    header("Location: ../404.html");
    exit;
}

// Get the userID from session
$userID = $_SESSION['user_id'];

// Include your database connection file
include '../process/db_config.php';

// Query to fetch all user data based on user_id
$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Fetch user data as associative array
    $userData = $result->fetch_assoc();

    // Assign variables for easy access
    $username = $userData['username'];
    $email = $userData['email_address'];
    $userCategory = $userData['user_category'];
    $profile = !empty($userData['profile_image']) ? '../assets/admin/img/' . $userData['profile_image'] : '../assets/img/default.png';
    // Add more fields as needed
} else {
    echo "User data not found.";
}

// Query to count total employees
$sql_employees = "SELECT COUNT(*) AS total_employees FROM employees";
$result_employees = $conn->query($sql_employees);

// Fetch the employee count
$total_employees = 0;
if ($result_employees->num_rows > 0) {
    $row_employees = $result_employees->fetch_assoc();
    $total_employees = $row_employees['total_employees'];
}

// Query to count total departments
$sql_departments = "SELECT COUNT(*) AS total_departments FROM departments";
$result_departments = $conn->query($sql_departments);

// Fetch the department count
$total_departments = 0;
if ($result_departments->num_rows > 0) {
    $row_departments = $result_departments->fetch_assoc();
    $total_departments = $row_departments['total_departments'];
}

// Query to count total designations
$sql_designations = "SELECT COUNT(*) AS total_designations FROM designations";
$result_designations = $conn->query($sql_designations);

// Fetch the designation count
$total_designations = 0;
if ($result_designations->num_rows > 0) {
    $row_designations = $result_designations->fetch_assoc();
    $total_designations = $row_designations['total_designations'];
}

// Query to count leave applications by status
$sql_leave_approved = "SELECT COUNT(*) AS total_approved FROM leaveapplications WHERE leave_status = 'approved'";
$result_leave_approved = $conn->query($sql_leave_approved);

$total_approved = 0;
if ($result_leave_approved->num_rows > 0) {
    $row_leave_approved = $result_leave_approved->fetch_assoc();
    $total_approved = $row_leave_approved['total_approved'];
}

$sql_leave_cancelled = "SELECT COUNT(*) AS total_cancelled FROM leaveapplications WHERE leave_status = 'cancelled'";
$result_leave_cancelled = $conn->query($sql_leave_cancelled);

$total_cancelled = 0;
if ($result_leave_cancelled->num_rows > 0) {
    $row_leave_cancelled = $result_leave_cancelled->fetch_assoc();
    $total_cancelled = $row_leave_cancelled['total_cancelled'];
}

$sql_leave_pending = "SELECT COUNT(*) AS total_pending FROM leaveapplications WHERE leave_status = 'pending'";
$result_leave_pending = $conn->query($sql_leave_pending);

$total_pending = 0;
if ($result_leave_pending->num_rows > 0) {
    $row_leave_pending = $result_leave_pending->fetch_assoc();
    $total_pending = $row_leave_pending['total_pending'];
}


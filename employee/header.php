<?php
session_start();

// Check if session variables are set
if (!isset($_SESSION['username']) || !isset($_SESSION['employee_id'])) {
    // Redirect to the 404 page or login page as needed
    header("Location: ../404.html");
    exit;
}

// Fetch employee_id from session
$employee_id = $_SESSION['employee_id'];

// Include your database connection file
include '../process/db_config.php';

// Query to fetch all employee data based on employee_id
$query = "SELECT * FROM employees WHERE employee_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Fetch employee data as associative array
    $userData = $result->fetch_assoc();

    // Assign variables for easy access
    $employee_id = $userData['employee_id'];
    $username = $userData['username'];
    // Assuming you fetch other needed fields like email, profile image, etc.
    $email = $userData['email_address'];
    // Check if profile image exists
    $profile = !empty($userData['profile_image']) ? '../assets/img/' . $userData['profile_image'] : '../assets/img/default.png';
} else {
    echo "User data not found.";
}

// Query to fetch leave applications with leave type names
$query_leave = "SELECT la.*, lt.leave_name FROM leaveapplications la 
                JOIN leavetypes lt ON la.leave_id = lt.leave_id 
                WHERE la.employee_id = ?";
$stmt_leave = $conn->prepare($query_leave);
$stmt_leave->bind_param("i", $employee_id);
$stmt_leave->execute();
$result_leave = $stmt_leave->get_result();

// Check if any records were fetched
$leaveApplications = [];
if ($result_leave->num_rows > 0) {
    while ($row = $result_leave->fetch_assoc()) {
        $leaveApplications[] = $row;
    }
}

// Query to count leave applications by status
$sql_leave_approved = "SELECT COUNT(*) AS total_approved FROM leaveapplications WHERE leave_status = 'approved' AND employee_id = $employee_id";
$result_leave_approved = $conn->query($sql_leave_approved);

$total_approved = 0;
if ($result_leave_approved->num_rows > 0) {
    $row_leave_approved = $result_leave_approved->fetch_assoc();
    $total_approved = $row_leave_approved['total_approved'];
}

$sql_leave_cancelled = "SELECT COUNT(*) AS total_cancelled FROM leaveapplications WHERE leave_status = 'cancelled'  AND employee_id = $employee_id";
$result_leave_cancelled = $conn->query($sql_leave_cancelled);

$total_cancelled = 0;
if ($result_leave_cancelled->num_rows > 0) {
    $row_leave_cancelled = $result_leave_cancelled->fetch_assoc();
    $total_cancelled = $row_leave_cancelled['total_cancelled'];
}

$sql_leave_pending = "SELECT COUNT(*) AS total_pending FROM leaveapplications WHERE leave_status = 'pending'  AND employee_id = $employee_id";
$result_leave_pending = $conn->query($sql_leave_pending);

$total_pending = 0;
if ($result_leave_pending->num_rows > 0) {
    $row_leave_pending = $result_leave_pending->fetch_assoc();
    $total_pending = $row_leave_pending['total_pending'];
}
// Close statements and result sets
$stmt->close();
$stmt_leave->close();
$conn->close();
?>
<?php
// Include database configuration
require_once 'db_config.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if the form is for deleting a user
    if (isset($_POST['delete_user'])) {
        // Validate and sanitize user input for deleting a user
        $user_id = $_POST['user_id'] ?? '';

        // Prepare and bind parameters for deleting a user
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id=?");
        $stmt->bind_param("i", $user_id);

        // Execute the statement for deleting a user
        if ($stmt->execute()) {
            header("Location: ../admin/manage_user.php");
            exit();
        } else {
            echo "Error deleting user: " . $stmt->error;
        }

        $stmt->close();
    } 
    // Check if the form is for deleting a leave type
    elseif (isset($_POST['delete_leave_type'])) {
        // Validate and sanitize user input for deleting a leave type
        $leave_id = $_POST['leave_id'] ?? '';

        // Prepare and bind parameters for deleting a leave type
        $stmt = $conn->prepare("DELETE FROM leavetypes WHERE leave_id=?");
        $stmt->bind_param("i", $leave_id);

        // Execute the statement for deleting a leave type
        if ($stmt->execute()) {
            header('Location: ../admin/manage_leave_type.php?delete=success');
            exit();
        } else {
            echo "Error deleting leave type: " . $stmt->error;
        }

        $stmt->close();
    }
    // Check if the form is for deleting a department
    elseif (isset($_POST['delete_department'])) {
        // Validate and sanitize user input for deleting a department
        $department_id = $_POST['department_id'] ?? '';

        // Prepare and bind parameters for deleting a department
        $stmt = $conn->prepare("DELETE FROM departments WHERE department_id=?");
        $stmt->bind_param("i", $department_id);

        // Execute the statement for deleting a department
        if ($stmt->execute()) {
            header('Location: ../admin/manage_department.php?delete=success');
            exit();
        } else {
            echo "Error deleting department: " . $stmt->error;
        }

        $stmt->close();
    } 
    // Check if the form is for deleting a designation
    elseif (isset($_POST['delete_designation'])) {
        // Validate and sanitize user input for deleting a designation
        $designation_id = $_POST['designation_id'] ?? '';

        // Prepare and bind parameters for deleting a designation
        $stmt = $conn->prepare("DELETE FROM designations WHERE designation_id=?");
        $stmt->bind_param("i", $designation_id);

        // Execute the statement for deleting a designation
        if ($stmt->execute()) {
            header('Location: ../admin/manage_designation.php?delete=success');
            exit();
        } else {
            echo "Error deleting designation: " . $stmt->error;
        }

        $stmt->close();
    } 
    // Check if the form is for deleting an employee
    elseif (isset($_POST['delete_employee'])) {
        // Validate and sanitize user input for deleting an employee
        $employee_id = $_POST['employee_id'] ?? '';

        // Prepare and bind parameters for deleting an employee
        $stmt = $conn->prepare("DELETE FROM employees WHERE employee_id=?");
        $stmt->bind_param("i", $employee_id);

        // Execute the statement for deleting an employee
        if ($stmt->execute()) {
            header('Location: ../admin/manage_employee.php?delete=success');
            exit();
        } else {
            echo "Error deleting employee: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid form submission.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>

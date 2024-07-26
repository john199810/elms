<?php
// Include database configuration
require_once 'db_config.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the form is for editing a user
    if (isset($_POST['edit_user'])) {
        // Validate and sanitize user input for editing a user
        $user_id = $_POST['user_id'] ?? '';
        $full_name = $_POST['full_name'] ?? '';
        $contact = $_POST['contact'] ?? '';
        $email = $_POST['email'] ?? '';
        $username = $_POST['username'] ?? '';
        $user_category = $_POST['user_category'] ?? '';

        // Prepare and bind parameters for updating a user
        $stmt = $conn->prepare("UPDATE users SET full_name=?, contact_number=?, email_address=?, username=?, user_category=? WHERE user_id=?");
        $stmt->bind_param("sssssi", $full_name, $contact, $email, $username, $user_category, $user_id);

        // Execute the statement for updating a user
        if ($stmt->execute()) {
            header("Location: ../admin/manage_user.php");
            exit();
        } else {
            echo "Error updating user: " . $stmt->error;
        }

        $stmt->close();
    }
    // Check if the form is for editing a leave type

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_leave_type'])) {
        // Validate and sanitize user input for editing a leave type
        $leave_id = intval($_POST['leave_id']);
        $edit_leave_name = $conn->real_escape_string($_POST['leave_name']);
        $edit_leave_description = $conn->real_escape_string($_POST['leave_description']);
        $edit_days_allowed = intval($_POST['number_of_days_allowed']);

        // Prepare and bind parameters for updating a leave type
        $stmt = $conn->prepare("UPDATE leavetypes SET leave_name=?, leave_description=?, number_of_days_allowed=? WHERE leave_id=?");
        $stmt->bind_param("ssii", $edit_leave_name, $edit_leave_description, $edit_days_allowed, $leave_id);

        // Execute the statement for updating a leave type
        if ($stmt->execute()) {
            header('Location: ../admin/manage_leave_type.php?edit=success');
            exit;
        } else {
            echo "Error updating leave type: " . $stmt->error;
        }

        $stmt->close();
    }

    // Check if the form is for editing user status
    elseif (isset($_POST['edit_status'])) {
        // Validate and sanitize user input for editing status
        $user_id = $_POST['user_id'] ?? '';
        $status = $_POST['status'] ?? '';

        // Prepare and bind parameters for updating user status
        $stmt = $conn->prepare("UPDATE users SET account_status=? WHERE user_id=?");
        $stmt->bind_param("si", $status, $user_id);

        // Execute the statement for updating user status
        if ($stmt->execute()) {
            // Redirect with success message
            header('Location: ../admin/manage_user.php?edit_status=success');
            exit;
        } else {
            echo "Error updating user status: " . $stmt->error;
        }

        $stmt->close();
    }
    // Check if the form is for editing department details
    elseif (isset($_POST['edit_department'])) {
        // Validate and sanitize user input for editing department details
        $department_id = $_POST['department_id'] ?? '';
        $edit_department_name = $_POST['edit_department_name'] ?? '';
        $edit_department_short_name = $_POST['edit_department_short_name'] ?? '';

        // Check if the department_name already exists to avoid duplication
        $check_stmt = $conn->prepare("SELECT department_id FROM departments WHERE department_name=? AND department_id <> ?");
        $check_stmt->bind_param("si", $edit_department_name, $department_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            echo "Department name already exists.";
        } else {
            // Prepare and bind parameters for updating department details
            $stmt = $conn->prepare("UPDATE departments SET department_name=?, department_short_name=? WHERE department_id=?");
            $stmt->bind_param("ssi", $edit_department_name, $edit_department_short_name, $department_id);

            // Execute the statement for updating department details
            if ($stmt->execute()) {
                header("Location: ../admin/manage_department.php?edit_department=success");
                exit();
            } else {
                echo "Error updating department: " . $stmt->error;
            }

            $stmt->close();
        }

        $check_stmt->close();
    }
    // Check if the form is for editing employee status details
    if (isset($_POST['edit_employee_status'])) {
        // Validate and sanitize user input for editing employee status details
        $employee_id = $_POST['employee_id'] ?? '';
        $account_status = $_POST['account_status'] ?? '';

        // Debugging: Output variables (for testing purposes)
        echo "Employee ID: $employee_id<br>";
        echo "Account Status: $account_status<br>";

        // Prepare and bind parameters for updating employee details
        $stmt = $conn->prepare("UPDATE employees SET account_status=? WHERE employee_id=?");
        $stmt->bind_param("si", $account_status, $employee_id);

        // Execute the statement for updating employee status details
        if ($stmt->execute()) {
            header("Location: ../admin/manage_employee.php?edit_employee_status=success");
            exit();
        } else {
            echo "Error updating status: " . $stmt->error;
        }

        $stmt->close();
    }


    // Check if the form is for editing designation details
    elseif (isset($_POST['edit_designation'])) {
        // Validate and sanitize user input for editing designation details
        $designation_id = $_POST['designation_id'] ?? '';
        $edit_designation_name = $_POST['edit_designation_name'] ?? '';
        $edit_designation_description = $_POST['edit_designation_description'] ?? '';

        // Check if the designation_name already exists to avoid duplication
        $check_stmt = $conn->prepare("SELECT designation_id FROM designations WHERE designation_name=? AND designation_id <> ?");
        $check_stmt->bind_param("si", $edit_designation_name, $designation_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            echo "Designation name already exists.";
        } else {
            // Prepare and bind parameters for updating designation details
            $stmt = $conn->prepare("UPDATE designations SET designation_name=?, designation_description=? WHERE designation_id=?");
            $stmt->bind_param("ssi", $edit_designation_name, $edit_designation_description, $designation_id);

            // Execute the statement for updating designation details
            if ($stmt->execute()) {
                header("Location: ../admin/manage_designation.php?edit_designation=success");
                exit();
            } else {
                echo "Error updating designation: " . $stmt->error;
            }

            $stmt->close();
        }

        $check_stmt->close();
    } else {
        echo "Invalid form submission.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();

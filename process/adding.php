<?php
// Include database configuration
require_once 'db_config.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the form is for adding a user
    if (isset($_POST['add_user'])) {
        // Validate and sanitize user input for adding a user
        $full_name = $_POST['full_name'] ?? '';
        $contact = $_POST['contact'] ?? '';
        $email = $_POST['email'] ?? '';
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $user_category = $_POST['user_category'] ?? '';

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare and bind parameters for inserting a user
        $stmt = $conn->prepare("INSERT INTO users (full_name, contact_number, email_address, username, password, user_category) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }
        $stmt->bind_param("ssssss", $full_name, $contact, $email, $username, $hashed_password, $user_category);

        // Execute the statement for inserting a user
        if ($stmt->execute()) {
            echo "User added successfully.";
            header("Location: ../admin/add_user.html");
            exit();
        } else {
            echo "Error adding user: " . $stmt->error;
        }

        $stmt->close();
    }
    
    // Check if the form is for adding a leave type
    elseif (isset($_POST['add_leave_type'])) {
        // Validate and sanitize user input for adding a leave type
        $leave_name = $_POST['leave_name'] ?? '';
        $description = $_POST['description'] ?? '';
        $days_allowed = $_POST['days_allowed'] ?? '';

        // Prepare and bind parameters for inserting a leave type
        $stmt = $conn->prepare("INSERT INTO leavetypes (leave_name, leave_description, number_of_days_allowed) VALUES (?, ?, ?)");
        if (!$stmt) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }
        $stmt->bind_param("ssi", $leave_name, $description, $days_allowed);

        // Execute the statement for inserting a leave type
        if ($stmt->execute()) {
            header('Location: ../admin/add_leave_type.html');
            exit;
        } else {
            echo "Error adding leave type: " . $stmt->error;
        }

        $stmt->close();
    }

    // Check if the form is for adding an employee
    elseif (isset($_POST['add_employee'])) {

        // Validate and sanitize user input for adding an employee
        function sanitize_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Sanitize form inputs
        $id_number = sanitize_input($_POST['id_number']);
        $gender = sanitize_input($_POST['gender']);
        $first_name = sanitize_input($_POST['first_name']);
        $middle_name = sanitize_input($_POST['middle_name']);
        $last_name = sanitize_input($_POST['last_name']);
        $age = sanitize_input($_POST['age']);
        $email = sanitize_input($_POST['email']);
        $contact = sanitize_input($_POST['contact']);
        $department = sanitize_input($_POST['department']);
        $designation = sanitize_input($_POST['designation']);
        $username = sanitize_input($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashed password for security

        // Default profile image path
        $default_profile_image = "../assets/img/default.jpg";
        $profile_picture = $default_profile_image; // Default profile picture

        // File upload handling
        if (isset($_FILES["profile"]) && $_FILES["profile"]["error"] == UPLOAD_ERR_OK) {
            $target_dir = "../assets/images/";
            $profile_picture = $target_dir . basename($_FILES["profile"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($profile_picture, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["profile"]["tmp_name"]);
            if ($check === false) {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["profile"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            $allowed_formats = array("jpg", "jpeg", "png", "gif");
            if (!in_array($imageFileType, $allowed_formats)) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Move uploaded file to target directory
            if ($uploadOk) {
                if (!move_uploaded_file($_FILES["profile"]["tmp_name"], $profile_picture)) {
                    echo "Sorry, there was an error uploading your file.";
                    $profile_picture = $default_profile_image; // Use default image on failure
                }
            }
        }

        // Insert data into MySQL database
        $stmt = $conn->prepare("INSERT INTO employees (employee_id_number, gender, first_name, middle_name, last_name, age, email_address, contact_number, department, designation, username, password, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }
        $stmt->bind_param("sssssssssssss", $id_number, $gender, $first_name, $middle_name, $last_name, $age, $email, $contact, $department, $designation, $username, $password, $profile_picture);

        if ($stmt->execute()) {
            echo "New employee added successfully.";
            header("Location: ../admin/add_employee.html");
            exit();
        } else {
            echo "Error adding employee: " . $stmt->error;
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

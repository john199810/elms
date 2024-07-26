<?php
session_start();
include('process/db_config.php');

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$qr_code = $data['qr_code'];

// Check if the QR code exists and account status is activated
$sql = "SELECT employee_id, account_status FROM employees WHERE qr_code = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $qr_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $employee_id = $row['employee_id'];
    $account_status = $row['account_status'];

    if ($account_status === 'Activated') {
        // Check existing attendance records for today
        $date = date('Y-m-d');
        $checkSql = "SELECT * FROM attendance_records WHERE employee_id = ? AND date = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("is", $employee_id, $date);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            $record = $checkResult->fetch_assoc();
            // Update the next attendance time
            if (is_null($record['check_in_time'])) {
                $updateSql = "UPDATE attendance_records SET check_in_time = NOW() WHERE employee_id = ? AND date = ?";
                $message = "Time In recorded successfully!";
            } elseif (is_null($record['lunch_break_start'])) {
                $updateSql = "UPDATE attendance_records SET lunch_break_start = NOW() WHERE employee_id = ? AND date = ?";
                $message = "Lunch Break Start recorded successfully!";
            } elseif (is_null($record['lunch_break_end'])) {
                $updateSql = "UPDATE attendance_records SET lunch_break_end = NOW() WHERE employee_id = ? AND date = ?";
                $message = "Lunch Break End recorded successfully!";
            } elseif (is_null($record['coffee_break_start'])) {
                $updateSql = "UPDATE attendance_records SET coffee_break_start = NOW() WHERE employee_id = ? AND date = ?";
                $message = "Coffee Break Start recorded successfully!";
            } elseif (is_null($record['coffee_break_end'])) {
                $updateSql = "UPDATE attendance_records SET coffee_break_end = NOW() WHERE employee_id = ? AND date = ?";
                $message = "Coffee Break End recorded successfully!";
            } elseif (is_null($record['check_out_time'])) {
                $updateSql = "UPDATE attendance_records SET check_out_time = NOW() WHERE employee_id = ? AND date = ?";
                $message = "Time Out recorded successfully!";
            } else {
                $response = ['success' => false, 'message' => 'All attendance records are already recorded for today.'];
                echo json_encode($response);
                exit;
            }
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("is", $employee_id, $date);
            $updateStmt->execute();
        } else {
            // Insert new attendance record
            $insertSql = "INSERT INTO attendance_records (employee_id, date, check_in_time) VALUES (?, ?, NOW())";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bind_param("is", $employee_id, $date);
            $insertStmt->execute();
            $message = "Time In recorded successfully!";
        }

        $response = ['success' => true, 'message' => $message];
    } else {
        $response = ['success' => false, 'message' => 'Account is deactivated.'];
    }
} else {
    $response = ['success' => false, 'message' => 'Invalid QR Code.'];
}

echo json_encode($response);
?>

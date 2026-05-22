<?php

session_start();
require_once 'config.php';

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Registration.php');
    exit;
}

$fullName = test_input($_POST['fullName'] ?? '');
$dob = test_input($_POST['dob'] ?? '');
$nic = test_input($_POST['nid'] ?? '');
$address = test_input($_POST['address'] ?? '');
$phone = test_input($_POST['phone'] ?? '');
$email = test_input($_POST['email'] ?? '');
$occupation = test_input($_POST['occupation'] ?? '');
$gender = test_input($_POST['gender'] ?? '');
$regDate = test_input($_POST['regDate'] ?? '');

$errors = [];
if ($fullName === '') $errors[] = 'Full name is required.';
if ($dob === '') $errors[] = 'Date of birth is required.';
if ($nic === '') $errors[] = 'NIC is required.';
if ($address === '') $errors[] = 'Address is required.';
if ($phone === '') $errors[] = 'Phone number is required.';
if ($email === '') $errors[] = 'Email is required.';
if ($gender === '') $errors[] = 'Gender is required.';

// Normalize gender to match enum
$gender = ucfirst(strtolower($gender));
if (!in_array($gender, ['Male','Female','Other'])) {
    $errors[] = 'Invalid gender value.';
}

// Prepare registered_date value
$registeredDate = $regDate !== '' ? date('Y-m-d H:i:s', strtotime($regDate)) : date('Y-m-d H:i:s');

if (!empty($errors)) {
    $msg = implode('\\n', $errors);
    echo "<script>alert('Registration failed:\\n" . addslashes($msg) . "'); window.location.href='Registration.php';</script>";
    exit;
}

// Insert into database using prepared statement
$sql = "INSERT INTO residents (full_name, dob, nic, address, phone, email, occupation, gender, registered_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    error_log('DB prepare failed: ' . $conn->error);
    echo "<script>alert('Server error. Please try again later.'); window.location.href='Registration.php';</script>";
    exit;
}

if (!$stmt->bind_param('sssssssss', $fullName, $dob, $nic, $address, $phone, $email, $occupation, $gender, $registeredDate)) {
    error_log('Bind param failed: ' . $stmt->error);
    echo "<script>alert('Server error. Please try again later.'); window.location.href='Registration.php';</script>";
    exit;
}

if ($stmt->execute()) {
    echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
    $stmt->close();
    exit;
}

// Handle errors (e.g., duplicate nic)
if ($stmt->errno === 1062) {
    echo "<script>alert('NIC already exists. Please check and try again.'); window.location.href='Registration.php';</script>";
} else {
    error_log('Insert failed: ' . $stmt->error);
    echo "<script>alert('Registration failed due to server error.'); window.location.href='Registration.php';</script>";
}

$stmt->close();
?>
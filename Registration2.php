<?php
session_start();
include "config.php";

if (isset($_POST['submit'])) {
    $name = trim($_POST['full_name']);
    $dob = trim($_POST['dob']);
    $nid = trim($_POST['nid']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $occupation = trim($_POST['occupation']);
    $gender = trim($_POST['gender']);

    $stmt = $conn->prepare("SELECT 1 FROM resident_database. WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email already exists!'); window.location.href='signup.php';</script>";
    } else {
        $stmt->close();

        $insertStmt = $conn->prepare("INSERT INTO resident_database (full_name, dob, nid, address, phone, email, occupation, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param("ssssssss", $name, $dob, $nid, $address, $phone, $email, $occupation, $gender);

        if ($insertStmt->execute()) {
            header("Location: ok.php");
            exit();
        } else {
            echo "<script>alert('User registration failed! Please try again.'); window.location.href='signup.php';</script>";
        }

        $insertStmt->close();
    }
}
?>

<?php
session_start();

$row = $_SESSION['row_data'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify</title>
</head>
<body>
    <h1>Grama Niladari Residential Management System</h1>

    <form action="modify_process.php" method="post">
        <h3>Modify Details</h3>

        <label>Full Name: <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($row['full_name'] ?? ''); ?>"></label>

        <label>Date of Birth: <input type="text" id="dob" name="dob" value="<?php echo htmlspecialchars($row['dob'] ?? ''); ?>"></label>

        <label>NIC: <input type="text" id="nic" name="nic" value="<?php echo htmlspecialchars($row['nic'] ?? ''); ?>"></label>

        <label>Address: <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($row['address'] ?? ''); ?>"></label>

        <label>Phone: <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($row['phone'] ?? ''); ?>"></label>

        <label>Email: <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email'] ?? ''); ?>"></label>

        <label>Occupation: <input type="text" id="occupation" name="occupation" value="<?php echo htmlspecialchars($row['occupation'] ?? ''); ?>"></label>

        <label>Gender:
            <select id="gender" name="gender">
                <option value="">Select gender</option>
                <option value="Male" <?php echo (($row['gender'] ?? '') === 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo (($row['gender'] ?? '') === 'Female') ? 'selected' : ''; ?>>Female</option>
                <option value="Other" <?php echo (($row['gender'] ?? '') === 'Other') ? 'selected' : ''; ?>>Other</option>
            </select>
        </label>
    </form>
</body>
</html>
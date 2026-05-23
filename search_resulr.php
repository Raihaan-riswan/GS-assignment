<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
    background-image: url("image/Screenshot 2026-05-19 204159.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-color: #f0f0f0;
        }
        * {
    animation: blurPulse 0.5s ease-in-out forwards;
}

@keyframes blurPulse {
    0% {
        filter: blur(8px);
    }
    100% {
        filter: blur(0px);
    }
}

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        }

        .message {
            margin-bottom: 16px;
            font-weight: 600;
        }

        .result-card {
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 18px;
            margin-bottom: 16px;
            background: #fcfdff;
        }

        .result-card p {
            margin: 8px 0;
        }

        .back-link {
            display: inline-block;
            margin-top: 12px;
            text-decoration: none;
            color: #1d4ed8;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <?php
    require_once 'config.php';

    $fullName = trim($_POST['Ful_name'] ?? '');
    $nic = trim($_POST['Nic'] ?? '');
    $address = trim($_POST['Address'] ?? '');

    $message = '';
    $results = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $fullName === '' && $nic === '' && $address === '') {
        $message = 'Please enter at least one search value.';
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = 'SELECT id, full_name, dob, nic, address, phone, email, occupation, gender, registered_date
                FROM residents
                WHERE 1=1';

        $params = [];
        $types = '';

        if ($fullName !== '') {
            $sql .= ' AND full_name LIKE ?';
            $params[] = "%{$fullName}%";
            $types .= 's';
        }

        if ($nic !== '') {
            $sql .= ' AND nic LIKE ?';
            $params[] = "%{$nic}%";
            $types .= 's';
        }

        if ($address !== '') {
            $sql .= ' AND address LIKE ?';
            $params[] = "%{$address}%";
            $types .= 's';
        }

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die('Database error. Please try again later.');
        }

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $results = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $message = 'No resident found.';
        }

        $stmt->close();
    }
    ?>

    <div class="container">
        <h1>Search Results</h1>

        <?php if ($message !== ''): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <?php if (!empty($results)): ?>
            <?php foreach ($results as $row): ?>
                <div class="result-card">
                    <p><strong>Resident ID:</strong> <?php echo htmlspecialchars($row['id']); ?></p>
                    <p><strong>Full Name:</strong> <?php echo htmlspecialchars($row['full_name']); ?></p>
                    <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($row['dob']); ?></p>
                    <p><strong>National Identity Number:</strong> <?php echo htmlspecialchars($row['nic']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
                    <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($row['phone']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                    <p><strong>Occupation:</strong> <?php echo htmlspecialchars($row['occupation']); ?></p>
                    <p><strong>Gender:</strong> <?php echo htmlspecialchars($row['gender']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <a href="search.php" class="back-link">Back to Search</a>
    </div>
</body>
</html>


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

        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
            background: #ffffff;
        }

        .results-table th,
        .results-table td {
            border: 1px solid #cbd5e1;
            padding: 12px 14px;
            text-align: left;
            vertical-align: top;
        }

        .results-table th {
            background: #0f172a;
            color: #ffffff;
            font-weight: 700;
        }

        .results-table tbody tr:nth-child(even) {
            background: #f8fafc;
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
            <table class="results-table">
                <thead>
                    <tr>
                        <th>Resident ID</th>
                        <th>Full Name</th>
                        <th>Date of Birth</th>
                        <th>NIC</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Occupation</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['dob']); ?></td>
                            <td><?php echo htmlspecialchars($row['nic']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['occupation']); ?></td>
                            <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="search.php" class="back-link">Back to Search</a>
    </div>
</body>
</html>


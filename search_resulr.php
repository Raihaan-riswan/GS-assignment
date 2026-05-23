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

        .record-list {
            display: grid;
            gap: 16px;
            margin-top: 16px;
        }

        .record-card {
            background: linear-gradient(180deg, #ffffff, #f8fbff);
            border: 1px solid #dbeafe;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        }

        .record-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .record-header h2 {
            margin: 0;
            font-size: 1.15rem;
            color: #0f172a;
        }

        .record-id {
            background: #0f172a;
            color: #fff;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .record-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 14px;
        }

        .field-block {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 14px;
        }

        .field-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 6px;
        }

        .field-value {
            color: #0f172a;
            font-size: 0.98rem;
            word-break: break-word;
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
            <div class="record-list">
                <?php foreach ($results as $row): ?>
                    <div class="record-card">
                        <div class="record-header">
                            <h2><?php echo htmlspecialchars($row['full_name']); ?></h2>
                            <span class="record-id">ID: <?php echo htmlspecialchars($row['id']); ?></span>
                        </div>

                        <div class="record-grid">
                            <div class="field-block">
                                <span class="field-label">Date of Birth</span>
                                <div class="field-value"><?php echo htmlspecialchars($row['dob']); ?></div>
                            </div>

                            <div class="field-block">
                                <span class="field-label">NIC</span>
                                <div class="field-value"><?php echo htmlspecialchars($row['nic']); ?></div>
                            </div>

                            <div class="field-block">
                                <span class="field-label">Address</span>
                                <div class="field-value"><?php echo htmlspecialchars($row['address']); ?></div>
                            </div>

                            <div class="field-block">
                                <span class="field-label">Phone</span>
                                <div class="field-value"><?php echo htmlspecialchars($row['phone']); ?></div>
                            </div>

                            <div class="field-block">
                                <span class="field-label">Email</span>
                                <div class="field-value"><?php echo htmlspecialchars($row['email']); ?></div>
                            </div>

                            <div class="field-block">
                                <span class="field-label">Occupation</span>
                                <div class="field-value"><?php echo htmlspecialchars($row['occupation']); ?></div>
                            </div>

                            <div class="field-block">
                                <span class="field-label">Gender</span>
                                <div class="field-value"><?php echo htmlspecialchars($row['gender']); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <a href="search.php" class="back-link">Back to Search</a>
    </div>
</body>
</html>


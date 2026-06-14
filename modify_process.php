<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify process</title>
    <style>
        :root {
            --bg-1: #08111f;
            --bg-2: #14305c;
            --card: rgba(255, 255, 255, 0.94);
            --text: #0f172a;
            --muted: #475569;
            --success: #16a34a;
            --danger: #dc2626;
            --border: rgba(255, 255, 255, 0.18);
            --shadow: 0 28px 80px rgba(2, 8, 23, 0.32);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background: url("image/Screenshot 2026-05-19 204159.jpg");
             background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .shell {
            width: min(100%, 780px);
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: var(--shadow);
            padding: 28px;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        h1 {
            margin: 0 0 10px;
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            line-height: 1.1;
            color: #0f172a;
        }

        p {
            margin: 0 0 22px;
            color: var(--muted);
            line-height: 1.6;
        }

        .alert {
            padding: 16px 18px;
            border-radius: 14px;
            font-weight: 700;
            line-height: 1.5;
            border: 1px solid transparent;
        }

        .alert-success {
            background: #ecfdf5;
            color: #166534;
            border-color: #86efac;
        }

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border-color: #fca5a5;
        }

        .alert-info {
            background: #eff6ff;
            color: #1d4ed8;
            border-color: #bfdbfe;
        }

        .actions {
            margin-top: 18px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 16px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-home {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.24);
        }

        .btn-back {
            background: #ffffff;
            color: #0f172a;
            border: 1px solid #e2e8f0;
        }

        @media (max-width: 640px) {
            body {
                padding: 16px;
            }

            .card {
                padding: 20px;
                border-radius: 18px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="shell">
        <div class="card">
            <?php
            include('config.php');
            session_start();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_SESSION['row_data'])) {
                    $row = $_SESSION['row_data'];
                    $id = $row['id'];
                    $full_name = $_POST['full_name'] ?? '';
                    $dob = $_POST['dob'] ?? '';
                    $nic = $_POST['nic'] ?? '';
                    $address = $_POST['address'] ?? '';
                    $phone = $_POST['phone'] ?? '';
                    $email = $_POST['email'] ?? '';
                    $occupation = $_POST['occupation'] ?? '';
                    $gender = $_POST['gender'] ?? '';

                    $sql = "UPDATE residents SET full_name='$full_name', dob='$dob', nic='$nic', address='$address', phone='$phone', email='$email', occupation='$occupation', gender='$gender' WHERE id='$id'";

                    if ($conn->query($sql) === TRUE) {
                        echo "<h1>Record Updated</h1>";
                        echo "<p>Your resident details have been updated successfully.</p>";
                        echo "<div class='alert alert-success'>Record updated successfully.</div>";
                    } else {
                        echo "<h1>Update Failed</h1>";
                        echo "<p>Please review the details and try again.</p>";
                        echo "<div class='alert alert-danger'>Error updating record: " . htmlspecialchars($conn->error) . "</div>";
                    }
                } else {
                    echo "<h1>No Record Selected</h1>";
                    echo "<p>The session does not contain a resident record to update.</p>";
                    echo "<div class='alert alert-info'>Please go back to search results and choose a resident first.</div>";
                }
            } else {
                echo "<h1>Modify Process</h1>";
                echo "<p>This page accepts the resident update from the modify form.</p>";
                echo "<div class='alert alert-info'>Submit the form to update the resident record.</div>";
            }
            ?>

            <div class="actions">
                <a href="modify.php" class="btn btn-back">Back to Modify</a>
                <a href="search.php" class="btn btn-home">Go to Search</a>
                <a href="index.php" class="btn btn-home" style="background: linear-gradient(135deg, #10b981, #059669);">Go to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
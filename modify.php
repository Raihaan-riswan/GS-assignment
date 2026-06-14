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
    <style>
        :root {
            --bg-1: #07111f;
            --bg-2: #102848;
            --card: rgba(255, 255, 255, 0.92);
            --card-border: rgba(255, 255, 255, 0.16);
            --text: #0f172a;
            --muted: #64748b;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --danger: #dc2626;
            --shadow: 0 24px 80px rgba(2, 8, 23, 0.32);
            --radius: 24px;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(59, 130, 246, 0.28), transparent 30%),
                radial-gradient(circle at top right, rgba(14, 165, 233, 0.2), transparent 26%),
                linear-gradient(160deg, var(--bg-1), var(--bg-2));
            display: grid;
            place-items: center;
            padding: 24px;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
            opacity: 0.45;
        }

        .page-shell {
            width: min(100%, 1080px);
            position: relative;
            z-index: 1;
        }

        .hero {
            margin-bottom: 18px;
            text-align: center;
            color: #ffffff;
            animation: fadeUp 0.55s ease both;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.88);
            font-size: 0.82rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        h1 {
            margin: 16px 0 10px;
            font-size: clamp(2rem, 4vw, 3.5rem);
            line-height: 1.05;
            letter-spacing: -0.04em;
        }

        .hero p {
            margin: 0 auto;
            max-width: 720px;
            color: rgba(255, 255, 255, 0.78);
            font-size: 1rem;
            line-height: 1.6;
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(260px, 0.85fr) minmax(0, 1.15fr);
            gap: 18px;
            align-items: stretch;
        }

        .summary-card,
        .form-card {
            background: var(--card);
            border: 1px solid var(--card-border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            overflow: hidden;
            animation: fadeUp 0.7s ease both;
        }

        .summary-card {
            padding: 28px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 20px;
            background:
                linear-gradient(180deg, rgba(37, 99, 235, 0.94), rgba(15, 23, 42, 0.96));
            color: #ffffff;
        }

        .summary-card h2,
        .form-card h2 {
            margin: 0;
            font-size: 1.4rem;
            letter-spacing: -0.02em;
        }

        .summary-card p {
            margin: 12px 0 0;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.65;
        }

        .summary-list {
            display: grid;
            gap: 12px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .summary-list li {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            padding: 14px 15px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .summary-list strong {
            display: block;
            font-size: 0.95rem;
        }

        .summary-list span {
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.92rem;
            line-height: 1.45;
        }

        .form-card {
            padding: 28px;
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            align-items: flex-start;
            margin-bottom: 22px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
        }

        .form-header p {
            margin: 8px 0 0;
            color: var(--muted);
            line-height: 1.55;
        }

        .badge {
            flex: 0 0 auto;
            padding: 9px 12px;
            border-radius: 999px;
            background: #eff6ff;
            color: var(--primary-dark);
            font-size: 0.84rem;
            font-weight: 700;
            border: 1px solid #bfdbfe;
        }

        .fields {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field label {
            font-size: 0.88rem;
            font-weight: 700;
            color: #334155;
        }

        .field input,
        .field select {
            width: 100%;
            min-height: 50px;
            padding: 13px 14px;
            border-radius: 14px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: var(--text);
            font-size: 0.98rem;
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease, transform 0.15s ease;
        }

        .field input::placeholder {
            color: #94a3b8;
        }

        .field input:focus,
        .field select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.14);
        }

        .actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 22px;
            padding-top: 20px;
            border-top: 1px solid rgba(15, 23, 42, 0.08);
            flex-wrap: wrap;
        }

        .btn {
            appearance: none;
            border: none;
            border-radius: 14px;
            padding: 13px 18px;
            min-height: 48px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.15s ease, box-shadow 0.15s ease, background-color 0.15s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #ffffff;
            box-shadow: 0 12px 26px rgba(37, 99, 235, 0.22);
        }

        .btn-primary:hover {
            box-shadow: 0 16px 30px rgba(37, 99, 235, 0.28);
        }

        .btn-ghost {
            background: #f8fafc;
            color: #0f172a;
            border: 1px solid #e2e8f0;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, var(--danger));
            color: #ffffff;
            box-shadow: 0 12px 26px rgba(220, 38, 38, 0.16);
        }

        .empty-state {
            padding: 18px;
            margin-top: 18px;
            border-radius: 16px;
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
            line-height: 1.6;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 900px) {
            body {
                padding: 16px;
            }

            .layout {
                grid-template-columns: 1fr;
            }

            .summary-card {
                padding: 22px;
            }

            .form-card {
                padding: 22px;
            }
        }

        @media (max-width: 640px) {
            .hero {
                margin-bottom: 14px;
            }

            .eyebrow {
                font-size: 0.75rem;
                letter-spacing: 0.06em;
            }

            .summary-card,
            .form-card {
                border-radius: 20px;
            }

            .form-header {
                flex-direction: column;
            }

            .fields {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main class="page-shell">
        <section class="hero">
            <span class="eyebrow">Resident record editor</span>
            <h1>Grama Niladari Residential Management System</h1>
            <p>Edit resident information in a clean, focused layout that works smoothly on desktop, tablet, and mobile.</p>
        </section>

        <section class="layout">
            <aside class="summary-card">
                <div>
                    <h2>Update details with confidence</h2>
                    <p>This view keeps the form readable on small screens and highlights the most important fields first.</p>
                </div>

                <ul class="summary-list">
                    <li>
                        <div>
                            <strong>Responsive layout</strong>
                            <span>Two columns on larger screens, single column on phones.</span>
                        </div>
                    </li>
                    <li>
                        <div>
                            <strong>Clear visual hierarchy</strong>
                            <span>Card sections, soft gradients, and strong contrast for readability.</span>
                        </div>
                    </li>
                    <li>
                        <div>
                            <strong>Safe data binding</strong>
                            <span>Existing values are prefilled only when the session contains a resident record.</span>
                        </div>
                    </li>
                </ul>
            </aside>

            <section class="form-card">
                <div class="form-header">
                    <div>
                        <h2>Modify Details</h2>
                        <p>Review the current record, make changes, and save when ready.</p>
                    </div>
                    <span class="badge"><?php echo !empty($row) ? 'Record loaded' : 'No record selected'; ?></span>
                </div>

                <?php if (empty($row)): ?>
                    <div class="empty-state">
                        No resident data is available in this session. Please return to the search results and choose <strong>Modify</strong> for a resident first.
                    </div>
                <?php endif; ?>

                <form action="modify_process.php" method="post">
                    <div class="fields">
                        <div class="field full">
                            <label for="full_name">Full Name</label>
                            <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($row['full_name'] ?? ''); ?>" placeholder="Enter full name">
                        </div>

                        <div class="field">
                            <label for="dob">Date of Birth</label>
                            <input type="text" id="dob" name="dob" value="<?php echo htmlspecialchars($row['dob'] ?? ''); ?>" placeholder="YYYY-MM-DD">
                        </div>

                        <div class="field">
                            <label for="nic">NIC</label>
                            <input type="text" id="nic" name="nic" value="<?php echo htmlspecialchars($row['nic'] ?? ''); ?>" placeholder="Enter NIC">
                        </div>

                        <div class="field full">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($row['address'] ?? ''); ?>" placeholder="Enter address">
                        </div>

                        <div class="field">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($row['phone'] ?? ''); ?>" placeholder="Enter phone number">
                        </div>

                        <div class="field">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email'] ?? ''); ?>" placeholder="Enter email address">
                        </div>

                        <div class="field">
                            <label for="occupation">Occupation</label>
                            <input type="text" id="occupation" name="occupation" value="<?php echo htmlspecialchars($row['occupation'] ?? ''); ?>" placeholder="Enter occupation">
                        </div>

                        <div class="field">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender">
                                <option value="">Select gender</option>
                                <option value="Male" <?php echo (($row['gender'] ?? '') === 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo (($row['gender'] ?? '') === 'Female') ? 'selected' : ''; ?>>Female</option>
                                <option value="Other" <?php echo (($row['gender'] ?? '') === 'Other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="actions">
                        <a href="search.php" class="btn btn-ghost">Back to Search</a>
                        <button type="reset" class="btn btn-danger">Clear</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </section>
        </section>
    </main>
</body>
</html>
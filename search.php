<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="index.css">
    <style>
        /* Search page specific styles (kept local to search.html) */
        .search-container {
            max-width: 520px;
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            padding: 28px 32px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.25);
        }

        .search-container h1 {
            margin: 0 0 18px 0;
            font-size: 1.8rem;
            text-align: center;
            color: #12305a;
        }

        .search-form {
            display: grid;
            gap: 12px;
        }

        .search-form input[type="text"] {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid rgba(18, 48, 90, 0.12);
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
            transition: box-shadow 0.15s ease, border-color 0.15s ease;
        }

        .search-form input[type="text"]:focus {
            border-color: #2a3e6a;
            box-shadow: 0 4px 12px rgba(42,62,106,0.12);
        }

        .search-form .btn, .search-form button {
            display: inline-block;
            padding: 12px 16px;
            background: linear-gradient(180deg,#2a3e6a,#12305a);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.08s ease, box-shadow 0.12s ease;
        }

        .search-form .btn:hover, .search-form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(18,48,90,0.18);
        }

    </style>
</head>

<body>
    <div class="search-container">
        <h1>Search Resident</h1>
        <form action="search_resulr.php" method="post" class="search-form">
            <input type="text" name="Ful_name" placeholder="Full name" aria-label="Full name">
            <input type="text" name="Nic" placeholder="NIC" aria-label="NIC">
            <input type="text" name="Address" placeholder="Address" aria-label="Address">
            <button type="submit" name="submit" value="search" class="btn">Search</button>
        </form>
    </div>
</body>

</html>
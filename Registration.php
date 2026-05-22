<?php
$nameErr = $dobErr = $nidErr = $addressErr = $phoneErr = $emailErr = $occupationErr = $genderErr = $regDateErr = "";
$fullName = $dob = $nid = $address = $phone = $email = $occupation = $gender = $regDate = "";

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST["fullName"])) {
        $nameErr = "Full Name is required";
    } else {
        $fullName = test_input($_POST["fullName"]);
    }

    if (empty($_POST["dob"])) {
        $dobErr = "Date of Birth is required";
    } else {
        $dob = test_input($_POST["dob"]);
    }

    if (empty($_POST["nid"])) {
        $nidErr = "National Identity Number is required";
    } else {
        $nid = test_input($_POST["nid"]);
    }

    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = test_input($_POST["address"]);
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
    } else {
        $phone = test_input($_POST["phone"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["occupation"])) {
        $occupationErr = "Occupation is required";
    } else {
        $occupation = test_input($_POST["occupation"]);
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if (empty($_POST["regDate"])) {
        $regDateErr = "Registered Date is required";
    } else {
        $regDate = test_input($_POST["regDate"]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url(image/Screenshot\ 2026-05-19\ 204159.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background: #ffffff;
            box-shadow: 1px -1px 260px 40px rgba(0,0,0,0.75);
            border-radius: 10px;
            padding: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 24px;
            color: #1f4e79;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .radio-group {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .radio-group label {
            display: inline-flex;
            align-items: center;
            margin-bottom: 0;
            font-weight: 500;
        }

        .radio-group input {
            margin-right: 8px;
        }

        .button-row {
            text-align: center;
            margin-top: 24px;
        }

        button {
            background: #1f4e79;
            color: #fff;
            padding: 12px 28px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
        }

        button:hover {
            background: #163f61;
        }

        .error {
            color: #d93025;
            margin-top: 6px;
            font-size: 0.95rem;
        }
    </style>
</head>

<body>
    <main class="container">
        <h1>Registration Form</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" value="<?php echo $fullName; ?>">
                <p id="nameErr" class="error"><?php echo $nameErr; ?></p>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>">
                <p id="dobError" class="error"><?php echo $dobErr; ?></p>
            </div>
            <div class="form-group">
                <label for="nid">National Identity Number</label>
                <input type="text" id="nid" name="nid" placeholder="Enter your national identity number" value="<?php echo $nid; ?>">
                <p id="nidError" class="error"><?php echo $nidErr; ?></p>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" placeholder="Enter your address"><?php echo $address; ?></textarea>
                <p id="addressError" class="error"><?php echo $addressErr; ?></p>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo $phone; ?>">
                <p id="phoneError" class="error"><?php echo $phoneErr; ?></p>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
                <p id="emailError" class="error"><?php echo $emailErr; ?></p>
            </div>
            <div class="form-group">
                <label for="occupation">Occupation</label>
                <input type="text" id="occupation" name="occupation" placeholder="Enter your occupation" value="<?php echo $occupation; ?>">
                <p id="occupationError" class="error"><?php echo $occupationErr; ?></p>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <div class="radio-group">
                    <label><input type="radio" name="gender" value="male" <?php echo ($gender === "male") ? "checked" : ""; ?>>Male</label>
                    <label><input type="radio" name="gender" value="female" <?php echo ($gender === "female") ? "checked" : ""; ?>>Female</label>
                    <label><input type="radio" name="gender" value="other" <?php echo ($gender === "other") ? "checked" : ""; ?>>Other</label>
                </div>
                <p class="error"><?php echo $genderErr; ?></p>
            </div>
            <div class="form-group">
                <label for="regDate">Registered Date</label>
                <input type="date" id="regDate" name="regDate" value="<?php echo $regDate; ?>">
                <p id="regDateError" class="error"><?php echo $regDateErr; ?></p>
            </div>
            <div class="button-row">
                <button type="submit">Submit Registration</button>
            </div>
        </form>
    </main>
</body>

<?php
    $fullName = $dob = $nid = $address = $phone = $email = $occupation = $gender = $regDate = "";
  
    


</html>

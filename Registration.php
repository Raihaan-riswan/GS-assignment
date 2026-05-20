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
    </style>
</head>

<body>
    <main class="container">
        <h1>Registration Form</h1>
        <form>
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" placeholder="Enter your full name">
                <p id="fullNameError" class="error"></p>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob">
                <p id="dobError" class="error"></p>
            </div>
            <div class="form-group">
                <label for="nid">National Identity Number</label>
                <input type="text" id="nid" name="nid" placeholder="Enter your national identity number">
                <p id="nidError" class="error"></p>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" placeholder="Enter your address"></textarea>
                <p id="addressError" class="error"></p>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number">
                <p id="phoneError" class="error"></p>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">
                <p id="emailError" class="error"></p>
            </div>
            <div class="form-group">
                <label for="occupation">Occupation</label>
                <input type="text" id="occupation" name="occupation" placeholder="Enter your occupation">
                <p id="occupationError" class="error"></p>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <div class="radio-group">
                    <label><input type="radio" name="gender" value="male" required>Male</label>
                    <label><input type="radio" name="gender" value="female">Female</label>
                    <label><input type="radio" name="gender" value="other">Other</label>
                </div>
            </div>
            <div class="form-group">
                <label for="regDate">Registered Date</label>
                <input type="date" id="regDate" name="regDate">
                <p id="regDateError" class="error"></p>
            </div>
            <div class="button-row">
                <button type="submit">Submit Registration</button>
            </div>
        </form>
    </main>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify</title>
</head>
<body>
    <?php
          session_start();
          if(isset($_session['row_date'])){
            $row=$_session['row_date'];
          }
          ?>
          <h1>Grama niladari residential managment system</h1>
          <form action="modify_process.php" method="post">
              <h3>Modify Details</h3>


              <label>Full Name: <input type="text" id="full_name" name="full_name" value="<?php echo $row['full_name']; ?>"></label>

              <label>Date of Birth: <input type="text" id="dob" name="dob" value="<?php echo $row['dob']; ?>"></label>

              <label>NIC: <input type="text" id="nic" name="nic" value="<?php echo $row['nic']; ?>"></label>

              <label>Address: <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>"></label>

              <label>Phone: <input type="tel" id="phone" name="phone" value="<?php echo $row['phone']; ?>"></label>

              <label>Email: <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>"></label>

              <label>Occupation: <input type="text" id="occupation" name="occupation" value="<?php echo $row['occupation']; ?>"></label>

              <label>Gender: <select id="gender" name="gender" value="<?php echo $row['gender']; ?>">
                    <option value="">Select gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
            
              </label>




          </form>
</body>
</html>
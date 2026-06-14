<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify process</title>
</head>
<body>
    <?php
        include ('config.php');

        if(isset($_post['submit'])){


            session_start();
            if(isset($_SESSION['row_data'])){
                $row = $_SESSION['row_data'];
            }
            $id = $row['id'];
            $full_name = $_POST['full_name'];
            $dob = $_POST['dob'];
            $nic = $_POST['nic'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $occupation = $_POST['occupation'];
            $gender = $_POST['gender'];


            $sql = "UPDATE residents SET full_name='$full_name', dob='$dob', nic='$nic', address='$address', phone='$phone', email='$email', occupation'='$occupation', gender='$gender' WHERE id='$id'";

            if($conn->query($sql) === TRUE){
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    ?>
</body>
</html>
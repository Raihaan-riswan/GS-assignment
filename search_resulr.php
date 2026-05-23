<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include ('config.php');

        if(isset($_POST['submit'])){
            $fullName = $_POST['Ful_name'];
            $nic = $_POST['Nic'];
            $address = $_POST['Address'];

            $result = mysqli_query($conn, "SELECT * FROM resident WHERE fullName LIKE '%$fullName%' AND nic='$nic' AND address LIKE '%$address%'");

            if($result){
                echo"residents found";
                $row = mysqli_fetch_assoc($result);
            }else{
                echo"no resident found";
            }
        } 
    ?>
 

    <h1> Residential results found </h1>
    <div class="residential-details">
        <p><strong>Resident ID:</strong> <?php echo $row['Id']; ?></p>
        <p><strong>Full Name:</strong> <?php echo $row['full_Name']; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo $row['dob']; ?></p>
        <p><strong>National Identity Number:</strong> <?php echo $row['nic']; ?></p>
        <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
        <p><strong>Phone Number:</strong> <?php echo $row['phone']; ?></p>
        <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
        <p><strong>Occupation:</strong> <?php echo $row['occupation']; ?></p>
        <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
    </div>

</body>
</html>


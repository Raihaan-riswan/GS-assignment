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
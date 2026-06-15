<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>
<body>
    <?php
        include ('config.php');
        session_start();
        if(isset($_SESSION['row_data'])){
            $row = $_SESSION['row_data'];
        }

        $id = $row['id'];

        $sql = "DELETE FROM residents WHERE id = $id";
        


    ?>
</body>
</html>
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

              
          </form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
   <form method="post" action="login.php">
      <label for="fname">Username:</label><br>
      <input type="text" id="username" name="username" placeholder="Username"><br>
      <label for="lname">Password:</label><br>
      <input type="text" id="password" name="password" placeholder="Password"><br><br>
      <input type="submit" value="Submit" name="submit">
   </form> 
</body>
</html>

<?php
// database connection will be here
// include database and object files
include_once '../config/database_mysqli.php';
include_once '../objects/access.php';
// instantiate database and access object
$database = new Database();
$db = $database->getConnection();
// initialize object
$access = new Access($db);
// Verder met vaststellen: bestaat de apikey
   if(isset($_POST['submit']) 
   && isset($_POST['username']) && $_POST != NULL
   && isset($_POST['password']) && $_POST != NULL) {

      $username = mysqli_real_escape_string($db, $_POST['username']);
      $apiKey = mysqli_real_escape_string($db, $_POST['password']);
      $resultaat = $access->validate($username, $apiKey);

      if($resultaat) {
         echo '<br>Hoera, de apikey bestaat';
         $_SESSION['loggedin'] = 'logged';
      }else{
         echo '<br>Oeps, niet de juiste waarde';
      }

   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
table, th, td {
  border:1px solid black;
  border-collapse: collapse;
}

th, td {
    text-align: center;
}
</style>
    <title>Document</title>
</head>
<body>
    <?php $name = '';
      $email = '';
      $password = '';
      $update = false;
      
      ?>

    <div >
    <form action="registration.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>" required/><br>
    Name : <br> <input type="text" name="name" value="<?php echo $name; ?>" required/><br>
    Email : <br> <input type="text" name="email" value="<?php echo $email; ?>" required/><br>
    Password : <br> <input type="password" name="password" value="<?php echo $password; ?>" required/><br>
    
    <?php 
    if($update == true): 
    ?>
    <input type="submit" name="update" value="update"/>
    <?php else: ?>
        <input type="submit" name="submit" value="Submit"/>
    <?php endif; ?>
    
   </form>

   <form action="registration.php" method="post">
   <input type="submit" value="Show" name="show"/>
   </form>
    </div>
    <?php
      include('connection.php');
      if(isset($_POST['submit']))
      {
          $name = $_POST['name'];
          $email = $_POST['email'];
          $password = $_POST['password'];

          $sql  = "INSERT INTO data (name, email, password)
                   VALUES ('$name', '$email', '$password')";
        $data = mysqli_query($conn, $sql);
        if($data)
        {
            echo "<h1>Data is inserted</h1>";
        }
      }

      else if(isset($_POST['show']))
      {
          $obj = "SELECT id, name, email FROM data";
          $data = mysqli_query($conn, $obj);

          if(mysqli_num_rows($data)>0)
          {
            echo "<table style="."width:80%"."> <tr> <th>ID</th> <th>Name</th> <th>Email</th> <th>Operation</th> </tr>";
            while($row=mysqli_fetch_assoc($data)){
                $vID = $row["id"];
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td> <td> <a href='registration.php?delete=$vID'>delete</a> </td> </tr>" . "<br>";
            }
            echo "</table>";
          }
      }

      else if(isset($_GET['delete']))
      {
          $id = $_GET['delete'];
          $obj = "DELETE FROM data WHERE id=$id";
          mysqli_query($conn, $obj);
          
      }

      ?>

   
</body>
</html>
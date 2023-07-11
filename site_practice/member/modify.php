<?php
    $id = $_GET["id"];

    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email = $_POST["email"];
          
    include "../include/db_connect.php";

    $sql = "update _mem set pass='$pass', name='$name', email='$email'";
    $sql .= " where id='$id'";
    mysqli_query($connect, $sql);

    mysqli_close($connect);     

    echo "
	      <script>
	          location.href = '../main/index.php';
	      </script>
	  ";
?>
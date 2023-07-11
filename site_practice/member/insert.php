<?php
$id = $_POST["id"];
$pass = $_POST["pass"];
$name = $_POST["name"];
$email = $_POST["email"];
$regist_day = date("Y-m-d(H:i");

include "../include/db_connect.php";
$sql="select *from _mem where id='$id'";
$result = mysqli_query($connect,$sql);
$num_record = mysqli_num_rows($result);

if($num_record){
    echo "<script>alert('아이디가 중복됩니다. '); history.go(-1)</script>";
    exit;
}

$sql = "insert into _mem (id, pass, name, email,regist_day,level,point) values ('$id','$pass','$name','$email','$regist_day',1, 100)";
mysqli_query($connect,$sql);

mysqli_close($connect);

echo "<script> location.href='index.php?type=login_form';</script>";
?>

<?php
session_start();

if (isset($_SESSION["userid"])) 
$userid = $_SESSION["userid"];
else {
$userid = "";
}

if (isset($_SESSION["username"])) 
$username = $_SESSION["username"];
else 
$username = "";  

if(!$userid){
    echo "
        <script> alert('로그인 후 사용 가능합니다.');
        history.go(-1) </script>
    ";
    exit;
}

$table = $_GET["table"];

$subject = $_POST["subject"];
$content = $_POST["content"];
$is_html = $_POST["is_html"];

$subject = htmlspecialchars($subject, ENT_QUOTES);
$content = htmlspecialchars($content, ENT_QUOTES);
$regist_day = date("Y-m-d(H:i)");

$upload_dir = './data/';

$upfile_name = $_FILES["upfile"]["name"];
$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
$upfile_type = $_FILES["upfile"]["type"];
$upfile_size = $_FILES["upfile"]["size"];
$upfile_error = $_FILES["upfile"]["error"];

if($upfile_name&&!$upfile_error){
    $file = explode(".",$upfile_name);
    $file_name = $file[0];
    $file_ext = $file[1];

    $copied_file_name = date("Y_m_d_H_i_s");
    $copied_file_name .= ".".$file_ext;
    $uploaded_file = $upload_dir.$copied_file_name;

    if($upfile_size >10000000){
        echo "
            <script>
            alert('지정된 용량(10mbyte)을 초과하였습니다..');
            history.go(-1)
            </script>
        ";
        exit;
    }

    if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){
        echo "
            <script>
            alert('파일을 지정한 디렉토리에 복사하는데 실패하였습니다.');
            history.go(-1)
            </script>
        ";
        exit;
    }
}
else {
    $upfile_name = "";
    $upfile_type = "";
    $upfile_file_name ="";
}

include "../include/db_connect.php";
$sql = "insert into $table (id,name,subject,content,regist_day,file_name,file_type,file_copied,is_html) values ('$userid', '$username', '$subject', '$content', '$regist_day', '$file_name', '$file_ext', '$copied_file_name','$is_html')";

//이거 그냥 한줄로 하면 안되나?

mysqli_query($connect,$sql);

mysqli_close($connect);

echo "<script> location.href='index.php?type=list&table=$table' </script>";
?>


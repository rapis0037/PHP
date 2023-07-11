<?php
$num = $_GET["num"];
$page= $_GET["page"];

include "../include/db_connect.php";
$sql= "select * from $table where num=$num";
$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($result);

$id = $row["id"];
$name = $row["name"];
$subject = $row["subject"];
$regist_day = $row["regist_day"];

$is_html = $row["is_html"];
$content = $row["content"];
if($is_html = "y"){
    $content = htmlspecialchars_decode($content, ENT_QUOTES);
}
else{
    $connect = str_replace(" ","&nbsp", $content);
    $connect = str_replace("\n","<br>", $content);    
}

$file_name = $row["file_name"];
$file_type = $row["file_type"];
$file_copied = $row["file_copied"];
?>
<script>
    function ripple_check_input(){
        if(!document.ripple_form.ripple_content.value){
            alert("내용을 입력하세요.");
            document.ripple_form.ripple_content.focus();
            return;
        }
        document.ripple_form.submit();
    }
    function ripple_del(href){
        if(confirm("삭제한 자료는 복구할 수 없습니다.\n\n삭제하시겠습니까?")){
            document.location.href=href;
        }

    }
</script>
<ul class="board_view">
    <h2 class="title"><?=$board_title?> > 내용보기</h2>
    <li class="row1">
        <span class="col1"><b>제목:</b><?=$subject?></span>
        <span class="col2"><?=$name?> | <?=$regist_day?></span>
    </li>
    <li class="row2">
        <?php
        if($file_name){
            $file_path = "./data/".$file_copied;
            $file_size = filesize($file_path);

            echo "▷ 첨부파일: $file_name ($file_size Byte)&nbsp;&nbsp;&nbsp;&nbsp;<a href='download.php?num=$num&file_copied=$file_copied&file_name=$file_name&file_type=$file_type'> [저장] </a><br><br>";
        }
        echo $content;
        ?>
    </li>
</ul>

<?php
if($table=="_qna"){
    $table_ripple = $table."_ripple";

    $sql = "select * from $table_ripple where parent='$num' order by num";
    $ripple_result = mysqli_query($connect, $sql);

    $count = 0;

    while($row_ripple = mysqli_fetch_assoc($ripple_result)){
        $ripple_num = $row_ripple["num"];
        $ripple_id = $row_ripple["id"];
        $ripple_name = $row_ripple["name"];
        $ripple_content = $row_ripple["content"];

        $ripple_content = str_replace("\n", "<br>", $ripple_content);
        $ripple_content = str_replace(" ","&nbsp;",$ripple_content);
        $ripple_date = $row_ripple["regist_day"];
?>
        <div class="ripple_title">
            <span class="col1"><?=$ripple_name?></span>
            <span class="col2"><?=$ripple_date?></span>
            <span class="col3">
                <?php
                if($userlevel==1 or $userid=$ripple_id){
                    echo "<a href='delete_ripple.php?table=$table&num=$num&ripple_num=$ripple_num&page=$page'>삭제</a>";
                    echo "<a href='#'>삭제</a>";
                }
                ?>
            </span>
        </div>
        <div class="ripple_contnet">
            <?=$ripple_content?>
        </div>
    <?php
        $count++;
    }
    mysqli_close($connect);
    ?>
    <div class="ripple_box">
        <form name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$num?>&page=<?=$page?>">
            <div class="ripple_box1"><img src="../img/ripple_title.png"></div>
            <div class="ripple_box2"><textarea name="ripple_content"></textarea></div>
            <div class="ripple_box3"><a href="#"><img src="../img/ripple_button.png"></a></div>
        </form>
    </div>
<?php
}
?>
<ul class="buttons">
		<?php
			$list_url = "index.php?type=list&table=$table&page=$page";
			$modify_url = "index.php?type=modify_form&table=$table&num=$num&page=$page";
			$delete_url = "delete.php?table=$table&num=$num&page=$page";
			$write_url = "index.php?type=form&table=$table";
		?>
	<li><button onclick="location.href='<?=$list_url?>'">목록보기</button></li>
<?php
	if ($userlevel==1 or $userid==$id) {
?>
	<li><button onclick="location.href='<?=$modify_url?>'">수정하기</button></li>   
	<li><button onclick="location.href='<?=$delete_url?>'">삭제하기</button></li>
<?php
}
?>

<?php
	if ($userlevel==1 or $table=="_youtube" or  $table=="_qna") {
?>
	<li><button onclick="location.href='<?=$write_url?>'">글쓰기</button></li>
<?php
	}
?>			
</ul>
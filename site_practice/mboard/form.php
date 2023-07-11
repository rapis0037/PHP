<script>
    function cheak_input(){
        if(!document.board.subject.value){
            alert("제목을 입력해주세요,");
            document.board.subject.focus();
            return;
        }
        if(!document.board.content.value){
            alert("내용을 입력해주세요.");
            document.board.content.focus();
            return;
        }
        document.board.submit();
    }
</script>
<form name="board" method="post" action="insert.php?table=<?=$table?>" enctype="multipart/form-data">
    <ul class="board_form">
        <h2><?=$board_title?> > 글쓰기 </h2>
        <li>
            <span class="col1">이름:</span>
            <span class="col2"><?=$username?></span>
            <span class="is_html"><input type="checkbox" name="is_html" value="y">HTML 쓰기</span>
        </li>
        <li>
            <span class="col1">제목:</span>
            <span class="col2"><input name="subject" type="text"></span>

        </li>
        <li>
            <span class="col1">내용:</span>
            <span class="col2">
                <textarea name="content"></textarea>
            </span>
        </li>
        <li>
            <span class="col1">첨부파일:</span>
            <span class="col2"><input type="file" name="upfile"></span>
        </li>
    </ul>
    <ul class="buttons">
        <?php
        if ($userlevel == 1 or $table=="__youtube" or $table=="__qna"){
        ?>
        <li><button type="button" onclick="cheak_input()">저장하기</button></li>
        <?php
        }

        $list_url= "index.php?type=list&table=$table";
        ?>
        <li><button type="button" onclick="location.href='<?=$list_url?>'">목록보기</bytton></li>
    </ul>
</form>    


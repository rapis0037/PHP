<script>
    function check_input(){
        if(!document.member.id.value){
            alert("아이디를 입력해주세요");
            document.member.id.focus();
            retrun;
        }
        if(!document.member.pass.value){
            alert("비밀번호를 입력해주세요");
            document.member.pass.focus();
            retrun;
        }
        if(!document.member.pass_confirm.value){
            alert("비밀번호 확인을 입력해주세요");
            document.member.pass_confirm.focus();
            retrun;
        }
        if(!document.member.name.value){
            alert("이름을 입력해주세요");
            document.member.name.focus();
            retrun;
        }
        if(!document.member.email.value){
            alert("이메일을 입력해주세요");
            document.member.email.focus();
            retrun;
        }
        if(document.member.pass.value!=document.member.pass_confirm.value){
            alert("비밀번호가 일치하지 않습니다.\n다시입력해주세요.");
            document.member.pass.focus();
            document.member.pass.select();
            return;
        }
        document.member.submit();
    }
    function reset_form(){
        document.member.id.vlaue= "";
        document.member.pass.vlaue= "";
        document.member.pass_confirm.vlaue= "";
        document.member.name.vlaue= "";
        document.member.email.vlaue= "";
        document.member.id.focus();
    }
    function check_id(){
        window.open("check_id.php?id="+ document.member.id.value,"IDcheck","left=700,top=300,width=380,height=160,scrollbals=no,resizable=yes");
    }
</script>
<form method="post" action="insert.php" name="member">
    <div class="join_form">
        <h2>회원가입</h2>
        <ul>
            <li>
                <span class="col1">아이디</span>
                <span class="col2"><input type="text" name="id"></span>
                <span class="col3"><button type="button" onclick="check_id()">중복체크</span>
            </li>
            <li>
                <span class="col1">비밀번호</span>
                <span class="col2"><input type="password" name="pass"></span>
            </li>
            <li>
                <span class="col1">비밀번호확인</span>
                <span class="col2"><input type="passsword" name="pass_confirm"></span>
            </li>
            <li>
                <span class="col1">이름</span>
                <span class="col2"><input type="text" name="name"></span>
            </li>
            <li>
                <span class="col1">이메일</span>
                <span class="col2"><input type="text" name="email"></span>
            </li>
        </ul>
        <ul class="buttons">
            <li><button type="button" onclick="check_input()">저장하기</button></li>
            <li><button type="button" onclick="reset_form()">취소하기</button></li>
        </ul>
    </div>
</form>

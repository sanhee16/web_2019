
<!DOCTYPE html>
<html lang="ko">
  <?php
    session_start();
    include 'header.php';
    include 'define.php';
  ?>
  <body role="document">
  <?php
    include 'navi.php';
    ?>

    <script type="text/javascript">
    function inputText(){
        var login = document.login;
        var user = login.user.value;
        var pw = login.pw.value;
        if(!user){
            alert("아이디를 입력해주세요.")
        }else if(!pw){
            alert("패스워드를 입력해주세요.")
        }else{
            login.submit();
        }
    }
    </script>

    <div style="text-align:center">

      <br/><br/><br/><br/>

      <p><text style="font-size:30px;">LOGIN</p>
      <br/><br/>
      <form name = "login" action="login_process.php" method="POST" >
        <p><input type="text" name="user" placeholder="id" class="form-control"
        style="font-size:13pt; resize: none; height: 50px; width: 200px; margin:auto;"></p>
        <p><input name = "pw" type="password" class="form-control" placeholder="pw"                 style="font-size:13pt; resize: none; height: 50px; width: 200px; margin:auto;"></p>
        <br/>
        <p><input type="button" onclick="inputText()" value="로그인" class="btn btn-s btn-default"></p>
      </form>
    </div>
    </body>
  </html>

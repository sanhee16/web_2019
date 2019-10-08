<!doctype html>

<html lang="ko">

  <script type="text/javascript">
  var input_pw = prompt('비밀번호를 입력하세요', '숫자4자리');
  </script>
  <script type="text/javascript">
    var board_pw_corret = "0000";
  </script>

  <?php
    session_start();
    include 'header.php';
    include 'define.php';
  ?>

  <body role="document">
  <?php
    include 'navi.php';
    include 'sql_connect.php';

    $sql = "SELECT * FROM board";
    $result = mysqli_query($conn, $sql);
    $board_pw_corret = "0000";
    if(isset($_GET['id'])) {
      $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
      $sql = "SELECT * FROM board WHERE id={$filtered_id}";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
      if($row['board_pw']==""){
        $board_pw_corret="0000";
      }else{
        $board_pw_corret = htmlspecialchars($row['board_pw']);
      }
    }
    ?>

    <script type="text/javascript">
      var board_pw_corret = "<?echo $board_pw_corret; ?>"
    </script>
    <script type="text/javascript">
      if(board_pw_corret == input_pw){
        <?if($_GET['kind']=="update"){?>
          location.href="update.php?id=<?=$_GET['id']?>";
        <?}else if($_GET['kind']=="delete"){?>
          location.href="process_delete.php?id=<?=$_GET['id']?>";
        <?}?>
      }else if(input_pw==null){
        history.back();
        //alert(pvalue);
      }else{
        alert("비밀번호가 틀렸습니다.");
        history.back();
      }

    </script>
    <!--
  <div style="text-align:center">

    <br/><br/><br/><br/>

    <p><text style="font-size:30px;">비밀번호를 입력하세요</p>
    <br/><br/>
    <form name = "login" action="login_process.php" method="POST" >
      <p><input type="text" name="board_pw" placeholder="숫자4자리" class="form-control"
      style="font-size:13pt; resize: none; height: 50px; width: 200px; margin:auto;"></p><br/>
      <p><input type="button" onclick="check_pw()" value="확인" class="btn btn-s btn-default"></p>
    </form>
  </div>
-->
</body>
</html>

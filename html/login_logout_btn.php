
<script>
  $('#login_button').hide();
  $('#logout_button').hide();
</script>
<div style="text-align:right; margin-top:7px;">
<button type="button" onclick="location.href='login.php'" class="btn btn-s btn-default" id="login_button" >로그인</button>
<button type="button" onclick="location.href='logout.php'" class="btn btn-s btn-default" id="logout_button">로그아웃</button>
<button type="button" onclick="location.href='join.php'" class="btn btn-s btn-default">회원가입</button>
<?
$login = -1;
session_start();
  if(!isset($_SESSION['user'])){
    //로그인 안됨
    $login=0;
  }
  else{
    //로그인 됨
    $login=1;
  }
?>
<script>
var login = 5;
login = "<? echo $login; ?>";
$('#login_button').hide();
$('#logout_button').hide();
  if(login==0){
    //로그인 된 상태
    $('#login_button').show();
    $('#logout_button').hide();
  }else if(login==1){
    $('#logout_button').show();
    $('#login_button').hide();
  }else{
    alert("?");
  }
</script>

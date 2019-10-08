  <?php
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
    if(login==0){
      //로그인 안 된 상태
      alert("로그인 하세요");
      location.href="login.php";
    }else if(login==1){
      //로그인 된 상태

    }else{
      alert("?");
    }
  </script>

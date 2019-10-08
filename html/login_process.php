
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
    include 'sql_connect.php';
    ?>
    <?php
    //session_start(); // 세션
    //DB connect, 접속
    $user = $_POST['user']; // 아이디
    $pw = $_POST['pw']; // 패스워드

    $conn = mysqli_connect(
      'localhost',
      'sinhioa20',
      'mysql0322*',
      'sinhioa20'
    );
    mysqli_query($conn,"set session character_set_connection=utf8");
    mysqli_query($conn,"set session character_set_results=utf8;");
    mysqli_query($conn,"set session character_set_client=utf8;");

    $sql = "SELECT * FROM memberinformation where user='$user' and pw='$pw'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);



    if($user==$row['user'] && $pw==$row['pw']){ // id와 pw가 맞다면 login
       $_SESSION['user']=$row['user'];
       $_SESSION['name']=$row['name'];
       echo "<script>location.href='index.php';</script>";

    }else{ // id 또는 pw가 다르다면 login 폼으로
       echo "<script>window.alert('invalid username or password');</script>"; // 잘못된 아이디 또는 비빌번호 입니다
       echo "<script>location.href='login.php';</script>";

    }
?>

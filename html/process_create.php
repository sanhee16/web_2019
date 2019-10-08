<?php
session_start();
include 'header.php';
include 'define.php';
include 'sql_connect.php';


$sql = "
  INSERT INTO board
    (title, description, created, writer, board_pw)
    VALUES(
        '{$_POST['title']}',
        '{$_POST['description']}',
        NOW(),
        '{$_POST['writer']}',
        '{$_POST['board_pw']}'
    )
";
$result = mysqli_query($conn, $sql);
if($result === false){
  echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
} else {
Header("Location:boardList.php?pageNum=1&page=1&listLimit=$limitListNum");

  //echo '성공했습니다. <a href="board.php"> 첫 화면으로 </a>';
}
?>

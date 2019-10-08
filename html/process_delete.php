<!doctype html>

<html lang="ko">
<?php
include 'define.php';
include 'sql_connect.php';

settype($_GET['id'], 'integer');
$filtered = array(
  'id'=>mysqli_real_escape_string($conn, $_GET['id'])
);
  echo $filtered['id'];
$sql = "
  DELETE
    FROM board
    WHERE id = {$filtered['id']}
";
$result = mysqli_query($conn, $sql);
if($result === false){
  echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
} else {
  Header("Location:boardList.php?pageNum=1&page=1&listLimit=$limitListNum");
  //echo '삭제에 성공했습니다. <a href="board.php">돌아가기</a>';
}
?>
</body>
</html>

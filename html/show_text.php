<?php
//database 선택하기~
$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'phpstudy');

//글 목록 가져오기~
$sql = "SELECT * FROM board";
$result = mysqli_query($conn, $sql);

$sql = "SELECT * FROM board WHERE id = 2";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

echo '<h1>'.$row['title'].'</h1>';
echo $row['description'];

?>

<?php
//database 선택하기~
$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'phpstudy');


//글 목록 가져오기~
$sql = "SELECT * FROM board";
/*
모든데이터를 가져오면 안되니까 limit를 해서 가져와야 한다. 지금은 필요 없음
*/
$result = mysqli_query($conn, $sql);

/*
//var_dump($result);
mysqli_query 는 읽기와 관련된 명령을 실행했을 때,
mysalresult 를 return 한다.
//var_dump($result->num_rows);
*/



//mysqli_fetch_array사용하기
/*
php에서 사용하기 위해서는,
php datatype으로 전환해서 사용해야한다.
*/

$sql = "SELECT * FROM board WHERE id = 2";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
// 배열이 return 된다.
//print_r($row);


echo '<h1>'.$row['title'].'</h1>';
echo $row['description'];







?>

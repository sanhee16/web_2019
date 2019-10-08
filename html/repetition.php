<?php
header("content-type:text/html; charset=utf-8");

//중복확인 하는 곳!
//DB connect, 접속
$conn = mysqli_connect(
  'localhost',
  'sinhioa20',
  'mysql0322*',
  'sinhioa20'
);
mysqli_query($conn,"set session character_set_connection=utf8");
mysqli_query($conn,"set session character_set_results=utf8;");
mysqli_query($conn,"set session character_set_client=utf8;");

$sql = "SELECT * FROM memberinformation";
$result = mysqli_query($conn, $sql);
//$row = mysqli_fetch_array($result);
$repet = 1;
settype($_POST['username'], 'string');
$id =$_POST['username'];

$arr = array("pass");

$snd_result = "pass";
/*
0 검사안함
1 중복안됨 -> 사용가능
2 중복됨 -> 사용불가능
*/
while($row = mysqli_fetch_array($result)){
  if($row['user']==$id){
    $repet = 2;
    $snd_result = 'fail';
    $arr['overlap']='fail';
    break;
  }else{
    $snd_result = 'pass';
    $arr['overlap']= 'pass';
    $repet = 1;
  }
}

echo json_encode($repet);
?>

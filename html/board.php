<!doctype html>

<html lang="ko">
  <?php
    include 'check_login.php';
    session_start();
    include 'header.php';
    include 'define.php';
  ?>

  <body role="document">
  <?php
    include 'navi.php';
    include 'sql_connect.php';
    $sql = "SELECT * FROM ";
    $result = mysqli_query($conn, $sql);
    $list = '';

    $article = array(
      'title'=>'Welcome',
      'description'=>'Hello, web',
      'id'=>'0',
      'writer'
    );
    $update_link = '';
    $delete_link = '';

    if(isset($_GET['id'])) {
      $sql = "SELECT * FROM board WHERE id={$_GET['id']}";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
      $article['title'] = $row['title'];
      $article['description'] = $row['description'];
      $article['writer'] = $row['writer'];
      $article['id']=$_GET['id'];
    }
    ?>

  <div class="container theme-showcase" role="main">
  <div class="page-header">
    <h1><?=$article['title']?></h1>
  </div>

  <div style="text-align:right">
      작성자 : <?=$article['writer']?></br></br>
    </div>
    <div class="panel panel-danger">
      <div class="panel-body">
        <?=$article['description']?>
      </div>
    </div>
<!--
<div id = "show-board">
  <div id = "show-board-title">
    <h2>
    &nbsp; 제목 :
      <?=$article['title']?></h2>

      </div>
    <div id = "show-board-description">
    <?=$article['description']?>
    </br></br>
  </div>

-->

    <div style="text-align:right">
      <button type="button" onclick="location.href='enter_pw.php?kind=update&id=<?=$article['id']?>'" class="btn btn-s btn-default">수정</button>


      <button type="button" onclick="location.href='enter_pw.php?kind=delete&id=<?=$article['id']?>'" class="btn btn-s btn-default">삭제</button>              <input type="hidden" name="id" value="'.$_GET['id'].'">

    </div>

  </div>
  </body>
</html>

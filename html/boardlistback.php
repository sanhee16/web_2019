<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
    <!--  -->
    <link rel="stylesheet" href="style.css">
    <div id="menuBar">
      <?php
        $m1 = '<a href="boardList.php?pageNum=1&page=1&listLimit=2" class="menu-text"> 게시판 </a>';
        $m2 = '<a href="m2.php" class="menu-text"> 메뉴 2 </a>';
      ?>
      <div class="icon">
        <img src="whiteplane.png" alt="My Image" height="40px" width="40px">
      </div>
      <div class="menu1">
      <?=$m1?>
      &nbsp;
      <?=$m2?>
      &nbsp;
      </div>

    </div>
  </head>


    <h1>게시판</h1>

      <?php
      $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'phpstudy');
        $sql = "SELECT * FROM board";
        $result = mysqli_query($conn, $sql);
        $list = '';

        while($row = mysqli_fetch_array($result)){
          $list = $list."<li><a href= \"board.php?id={$row['id']}\" class = \"title-text\">{$row['title']} </a></li>";
          //id 값 가지고 이동!
        }

        $article = array(
          'title'=>'Welcome',
          'description'=>'Hello, web'
        );
        $update_link = '';
        $delete_link = '';

        if(isset($_GET['id'])) {
          $sql = "SELECT * FROM board WHERE id={$_GET['id']}";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($result);
          $article['title'] = $row['title'];
          $article['description'] = $row['description'];

          $update_link = '<a href="update.php?id='.$_GET['id'].'" class = "title-text" > 글 수정하기</a>';


          $delete_link = '
            <form action="process_delete.php" method="post">
              <input type="hidden" name="id" value="'.$_GET['id'].'">
              <input type="submit" value="delete">
            </form>
          ';
        }

      ?>


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


    <?=$update_link?>
    </br></br>
    <?=$delete_link?>
</div>
  </body>
</html>

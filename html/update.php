<!doctype html>

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


    $sql = "SELECT * FROM board";
    $result = mysqli_query($conn, $sql);
    $list = '';
    /*
    while($row = mysqli_fetch_array($result)) {
      $escaped_title = htmlspecialchars($row['title']);
      $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$escaped_title}</a></li>";
    }

    $article = array(
      'title'=>'Welcome',
      'description'=>'Hello, web',
      'writer' => 'hi'
    );
    $update_link = '';
    */
    if(isset($_GET['id'])) {
      $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
      $sql = "SELECT * FROM board WHERE id={$filtered_id}";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
      $article['title'] = htmlspecialchars($row['title']);
      $article['description'] = htmlspecialchars($row['description']);
      $article['writer'] = htmlspecialchars($row['writer']);
      $update_link = '<a href="update.php?id='.$_GET['id'].'">update</a>';
    }
  ?>

  <div class="container theme-showcase" role="main">
    <div class="page-header">
      <h1>게시판</h1>
      </div>

      <script type="text/javascript">
      function inputText(){
          var new_post1 = document.new_post;
          var new_title = new_post.title.value;
          var new_description = new_post.description.value;
          var new_writer = new_post.writer.value;
          if(!new_title || !new_description || !new_writer){
              alert("모두 입력해주세요.")
          }else{
              new_post1.submit();
          }
      }
      </script>

    <form name = "new_post" action="process_update.php" method="POST">
      <input type="hidden" name="id" value="<?=$_GET['id']?>">
      <p><input type="text" name="title" placeholder="title"  value="<?=$article['title']?>" class="form-control"
      style="font-size:13pt;"></p>

      <p><input name = "writer" type="text" class="form-control" placeholder="writer" value="<?=$article['writer']?>"
        style="font-size:13pt;"></p>

      <p><textarea name="description" placeholder="description"
        class = "form-control" style="resize: none; height: 300px; font-size:12pt;"><?=$article['description']?></textarea></p>
        <div style="text-align:right">

        <p><input type="button" onclick="inputText()" value="수정 완료" class="btn btn-s btn-default"></p>
      </div>
    </form>
  </body>
</html>

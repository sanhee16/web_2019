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
          var new_pw = new_post.board_pw.value;

          var str = new_description;
          str = str.replace(/(?:\r\n|\r|\n)/g, '<br/>');
          alert(str);
          new_post.description.value = str;

          if(!new_title || !new_description || !new_writer || !new_pw){
              alert("모두 입력해주세요.")
          }else{
              new_post1.submit();
          }
      }
      </script>

      <form name = "new_post" action="process_create.php" method="POST">
        <p><input name = "title" type="text"  placeholder="제목" class="form-control"
        style="font-size:13pt;"
        ></p>
        <p><input name = "writer" type="text"  placeholder="작성자" class="form-control"
          style="font-size:13pt;"></p>
        <p><textarea name = "description"  placeholder="description" class = "form-control"
        style="resize: none;height: 300px;font-size:12pt;"
        ></textarea></p>
        <p>비밀번호를 입력하세요</p>
        <p><input name = "board_pw" placeholder="숫자4자리" class = "form-control" style="font-size:13pt;width: 110px;"
        ></input></p>
        <div style="text-align:right">
        <p><input type="button" onclick="inputText()" value="제출" class="btn btn-s btn-default"></p>
      </div>
    </form>
  </body>
</html>

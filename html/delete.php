<!doctype html>

<html lang="ko">
  <?php
    session_start();
    include 'header.php';
    include 'define.php';
  ?>

  <body role="document">
      <?php
      include 'enter_pw.php';
      ?>


      <button type="button" onclick="location.href='process_delete.php?id=<?=$article['id']?>'" class="btn btn-s btn-default">삭제</button>              <input type="hidden" name="id" value="'.$_GET['id'].'">

    </div>

  </div>
  </body>
</html>

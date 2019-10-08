<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>SANI HOME</title>

    <!-- Bootstrap core CSS -->
    <link href="./dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="./dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">
    <link href="/css/custom-theme.min.css" rel="stylesheet">
    <link href="/css/common.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <?php
    include 'define.php';
  ?>
  <body role="document">
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="boardList.php?pageNum=1&page=1&listLimit=<?=$limitListNum?>" ><img src="whiteplane.png" alt="My Image" height="20px" width="20px"></a>
              <a class="navbar-brand" href="boardList.php?pageNum=1&page=1&listLimit=<?=$limitListNum?>" >MAIN</a>
            </div>
              <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#">HOME</a></li>
                  <li><a href="boardList.php?pageNum=1&page=1&listLimit=<?=$limitListNum?>" class="menu-text"> 게시판 </a></li>
                  <li><a href="m2.php" class="menu-text">메뉴2</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li class="dropdown-header">Nav header</li>
                      <li><a href="#">Separated link</a></li>
                      <li><a href="#">One more separated link</a></li>
                    </ul>
                  </li>
                </ul>
                <div style="text-align:right; margin-top:7px;" >
                <button type="button" onclick="location.href='login.php'" class="btn btn-s btn-default">로그인</button>
                <button type="button" onclick="location.href='join.php'" class="btn btn-s btn-default">회원가입</button>
                </div>
              </div><!--/.nav-collapse -->
            </div>
          </nav>
          login page
          <?php
          //DB connect, 접속

          $conn = mysqli_connect(
            'localhost',
            'sinhioa20',
            'mysql0322*',
            'sinhioa20'
          );
          settype($_POST['id'], 'string');
          settype($_POST['pw'], 'string');
          settype($_POST['age'], 'integer');
          settype($_POST['zip'], 'integer');
          settype($_POST['addr1'], 'string');
          settype($_POST['addr2'], 'string');
          settype($_POST['affiliation'], 'string');
/*
          echo $_POST['id'];
          echo "<br/>";
          echo $_POST['pw'];
          echo "<br/>";
          echo $_POST['age'];
          echo "<br/>";
          echo $_POST['zip'];
          echo "<br/>";
          echo $_POST['addr1'];
          echo "<br/>";
          echo $_POST['addr2'];
          echo "<br/>";
          echo $_POST['affiliation'];
          echo "<br/>";
*/
          mysqli_query($conn,"set session character_set_connection=utf8");
          mysqli_query($conn,"set session character_set_results=utf8;");
          mysqli_query($conn,"set session character_set_client=utf8;");
          $sql = "
            INSERT INTO memberinformation
              (user, pw, age, zipcode, addr1, addr2, affiliation, created)
              VALUES(
                  '{$_POST['id']}',
                  '{$_POST['pw']}',
                  '{$_POST['age']}',
                  '{$_POST['zip']}',
                  '{$_POST['addr1']}',
                  '{$_POST['addr2']}',
                  '{$_POST['affiliation']}',
                  NOW()
              )
          ";
          $result = mysqli_query($conn, $sql);
          if($result === false){
            echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
            error_log(mysqli_error($conn));
          } else {
            Header("Location:index.php");
          }

          ?>



    </body>
  </html>

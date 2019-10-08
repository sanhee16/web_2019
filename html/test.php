<!doctype html>

<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>SANI HOME</title>
    <!-- Bootstrap core CSS -->
    <link href="./dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="./dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="theme.css" rel="stylesheet">
    <link href="/css/custom-theme.min.css" rel="stylesheet">
    <link href="/css/common.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="./assets/js/ie-emulation-modes-warning.js"></script>

  </head>

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
                    <li><a href="#">Home</a></li>
                    <li  class="active"s><a href="boardList.php?pageNum=1&page=1&listLimit=<?=$limitListNum?>" class="menu-text"> 게시판 </a></li>
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
                </div><!--/.nav-collapse -->
              </div>
            </nav>


<div class="container theme-showcase" role="main">
  <div class="page-header">
    <h1>게시판</h1>

  </div>
      <div style="text-align:right">
      <button type="button" onclick="location.href='create.php'" class="btn btn-s btn-default">새 글쓰기</button>
      <!--<a href="create.php">새로운 글 작성하기</a>-->
    </div>
      <div class="container theme-showcase" role="main">

      <?php
      include 'define.php';
      $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'phpstudy');

        mysqli_query($conn,"set session character_set_connection=utf8");
        mysqli_query($conn,"set session character_set_results=utf8;");
        mysqli_query($conn,"set session character_set_client=utf8;");

        $sql = "SELECT * FROM board";
        $result = mysqli_query($conn, $sql);
        $list = '';
        $board_num = 0;

        $listCount=0;
        $listNumArr = range(1, 10); // 1~2
        $listOrderCount=0;
        $listOrderNumArr = range(1, 10); // 1~2
        $listWriter = range(1, 10); // 1~2

        for($num=0;$num<10;$num++){
          $listOrderNumArr[$num] = "";
          $listNumArr[$num]= "";
          $listWriter[$num]="";
        }

        while($row = mysqli_fetch_array($result)){
          $board_num += 1;
          $calc_page = ceil($board_num/$_GET['listLimit']);
          $listOrderCount +=1;
          //id 값 가지고 이동!

              if(($_GET['page']-1)*$_GET['listLimit'] < $board_num &&
              $board_num < $_GET['page'] * $_GET['listLimit'] + 1){
/*
                echo $_GET['page']."<br/>";
                echo $_GET['listLimit']."<br/>";
                echo $_GET['pageNum']."<br/>";
*/
                $listNumArr[$listCount]="<a href= \"board.php?pageNum=$board_num&page=$calc_page&listLimit=<?=$limitListNum?>&id={$row['id']}\" class = \"title-text\">{$row['title']} </a>";


                $listWriter[$listCount] = $row['writer'];
                $listOrderNumArr[$listCount] = $listOrderCount;


                $listCount += 1;
                $list = $list."<li><a href= \"board.php?pageNum=$board_num&page=$calc_page&listLimit=<?=$limitListNum?>&id={$row['id']}\" class = \"title-text\">{$row['title']} </a></li>";
                if($board_num == $_GET['page'] * $_GET['listLimit'] ){
                //echo "$list";
              }
            }
        }
        $buyTotalCount = $board_num;

      ?>
        <div class="col-md-15">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>제목</th>
                <th>작성자</th>
              </tr>
            </thead>
            <tbody>
              <?php
                for($num=0;$num<10;$num++){
                  if($listOrderNumArr[$num]==""){
                    continue;
                  }
                  echo "
                  <tr>
                    <td>$listOrderNumArr[$num]</td>
                    <td>$listNumArr[$num]</td>
                    <td>$listWriter[$num]</td>
                  </tr>
                  ";
                }
               ?>
            </tbody>
          </table>
        </div>
        <br/><br/>
        <br/><br/>
    <!-- 페이징 그리기 -->
    <tr>
        <td height="30" align="center" valign="middle" colspan="50" style="border:1px #CCCCCC solid;">

<div style="text-align:center">
<?
    $pageNum = ($_GET['page']) ? $_GET['page'] : 1;     //page : default - 1
    $listLimit = ($_GET['listLimit']) ? $_GET['listLimit'] : 50; //page : default - 50

    $b_pageNum_list = 10; //블럭에 나타낼 페이지 번호 갯수
    $block = ceil($pageNum/$b_pageNum_list); //현재 리스트의 블럭 구하기


    $b_start_page = ( ($block - 1) * $b_pageNum_list ) + 1; //현재 블럭에서 시작페이지 번호
    $b_end_page = $b_start_page + $b_pageNum_list - 1; //현재 블럭에서 마지막 페이지 번호

    $total_page =  ceil($buyTotalCount/$listLimit); //총 페이지 수

    if ($b_end_page > $total_page){
        $b_end_page = $total_page;
      }

    if($pageNum >= $total_page){

      }
      
    if($pageNum <= 1){
        ?><font size=4 color=red>처음</font><?}
    else{?>
        <font size=4><a href= "boardList.php?pageNum=1&page=1&listLimit=<?=$limitListNum?>" class = \"title-text\">처음</a></font>
    <?}

?>
    </td>
    </tr>
    </div>
    </div>
    </div>
  </body>
</html>

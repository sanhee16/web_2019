<!doctype html>

<html lang="ko">
  <?php
    session_start();
    include 'define.php';
    include 'header.php';
  ?>
  <body role="document">
    <?php
      include 'navi.php';
    ?>

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
      include 'sql_connect.php';

        $sql = "SELECT * FROM board ORDER BY id ASC";
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
<?php
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

    if($pageNum <= 1){ ?>
        <font size=4 color=red>처음</font>
        <?php }else{ ?>
        <font size=4><a href= "boardList.php?pageNum=1&page=1&listLimit=<?=$limitListNum?>" class = \"title-text\">처음</a></font>
    <?php }



    if($block <=1){ ?>
        <font> </font>
    <?php }else{ ?>
        <font size=4><a href= "boardList.php?pageNum=$board_num&page=<?=$b_start_page-1?>&listLimit=<?=$limitListNum?>">이전</a></font>
    <?php }

    for($j = $b_start_page; $j <=$b_end_page; $j++)
    {

        if($pageNum == $j)
        { ?>
            <font size=4 color=red><?=$j?></font>
        <?php }else{ ?>
            <font size=4> <a href= "boardList.php?pageNum=$board_num&page=<?=$j?>&listLimit=<?=$limitListNum?>">
              <?=$j?></a></font>
            <?php
          }
    }



    $total_block = ceil($total_page/$b_pageNum_list);

    if($block >= $total_block){ ?>
    <font> </font>
    <?php }else{ ?>
        <font size=4>
        <a href= "boardList.php?pageNum=$board_num&page=<?=$b_end_page+1?>&listLimit=<?=$limitListNum?>">다음</a></font> <?php }



    if($pageNum >= $total_page){ ?>
            <font size=4 color=red>마지막</font>
        <?php
      }else{ ?>
    <font size=4>
    <a href= "boardList.php?pageNum=$board_num&page=<?=$total_page?>&listLimit=<?=$limitListNum?>">마지막</a></font> <?php }
    ?>

    </div>
    </td>
    </tr>
    </div>
    </div>
  </body>
</html>

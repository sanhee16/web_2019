
<!DOCTYPE html>
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


    ?>
      <div style="margin-left:30px;">

        <br/><br/><br/><br/>

        <p><text style="font-size:30px;">회원 가입</p>
        <br/><br/>
        <script>
          var user_check = "fail";

          function id_overlap_check() {

            $('#username_input').change(function () {
              $('#check').hide();
              $('#id_overlap_button').show();
              $('#username_input').attr("check_result", "fail");
              user_check = "fail";
            })


            if ($('#username_input').val() == '') {
              alert('아이디를 입력하세요.')
              return;
            }

            id_overlap_input = document.querySelector('input[name="id"]');

            $.ajax({
              type:"POST",
              url:"./repetition.php",
              //url: "{% url 'lawyerAccount:id_overlap_check' %}",
              data: {
                'username': id_overlap_input.value
              },
              datatype: 'json',
              success: function (data) {
                //alert(data);
                console.log(data['overlap']);
                console.log(data);
                if (data == 2) {
                  //중복임
                  alert("이미 존재하는 아이디 입니다.");
                  id_overlap_input.focus();
                  return;
                }
                else if(data == 1) {
                  //중복 아님
                  user_check = "sucess";
                  $('#username_input').attr("check_result", "success");
                  $('#check').show();
                  $('#id_overlap_button').hide();
                  return;
                }
                else{
                  alert("?");
                  alert(data);
                  console.log(data);
                }
              }
            });
          }
        </script>
        <script type="text/javascript">
        function inputText(){
            var join = document.join;
            var id = join.id.value;
            var pw = join.pw.value;
            var age = join.age.value;
            var zip = join.zip.value;
            var addr1 = join.addr1.value;
            var addr2 = join.addr2.value;
            var affiliation = join.affiliation.value;
            if(user_check == "fail"){
                alert("아이디 중복확인을 해주세요")
            }
            else if(!id || !pw || !age|| !zip|| !addr1|| !addr2){
                alert("모두 입력해주세요.")
            }else{
                join.submit();
            }
        }
        </script>
        <script>

        function openZipSearch() {
        	new daum.Postcode({
        		oncomplete: function(data) {
        			$('[name=zip]').val(data.zonecode); // 우편번호 (5자리)
        			$('[name=addr1]').val(data.address);
        			$('[name=addr2]').val(data.buildingName);
        		}
        	}).open();
        }

        </script>
        <form name = "join" action="join_process.php" method="POST" >
          <p>아이디<input type="text" name="id" id = "username_input" placeholder="아이디" check_result="fail" style="font-size:13pt; resize: none; height: 30px; width: 200px; margin-left:44px; margin-right:30px;" required>
          <button name="repId" type="button" onclick="id_overlap_check()" id="id_overlap_button" class="btn btn-s btn-default" required>중복검사</button>
          <img src="check.png" id="check" style="display: none;"  height="30px" width="30px"></p>
          <br/>
          <p>비밀번호<input name = "pw" type="password" placeholder="비밀번호" style="font-size:13pt; resize: none; height: 30px; width: 200px; margin-left:30px; margin-right:30px;" required></p>
          <br/>
          <p>나이<input name = "age" type="text" placeholder="" style="font-size:13pt; resize: none; height: 30px; width: 200px; margin-left:58px; margin-right:30px;" required></p>
          <br/>

          <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>

          우편번호  <input type="text" name="zip" style="width:80px; height:26px; margin-left:30px; margin-right:30px;" required />
          <button type="button" class="btn btn-s btn-default" style="width:60px; height:32px;" onclick="openZipSearch()" >검색</button></p>
          주소  <input name = "addr1" type="text" placeholder="" style="font-size:13pt; resize: none; width:300px; height:30px; margin-left:58px; margin-right:30px;"></p>
          상세  <input name = "addr2" type="text" placeholder="상세주소" style="font-size:13pt; resize: none; width:300px; height:30px; margin-left:58px; margin-right:30px;" required></p><br/>

          <p>회사명<input name = "affiliation" type="text" placeholder="" style="font-size:13pt; resize: none; height: 30px; width: 200px; margin-left:44px; margin-right:30px;" required></p>
          <br/>
          <p><input type="button" onclick="inputText()" value="회원 가입" class="btn btn-s btn-default"></p>
        </form>
      </div>

    </body>
  </html>

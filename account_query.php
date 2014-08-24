<div class="block">
<?php
  $set_prev_page = 0;
  if(!CheckLogin('customer'))
    returnPage_user();
  if(!isset($_GET['action']) || $_GET['action'] == NULL)
    returnPage_user();
  $id = $_SESSION['userid'];
  switch($_GET['action']){
    case 'change_pass':
      $oldpass = md5(md5($_POST['OLDPASS']));
      $newpass = $_POST['NEWPASS'];
      $repass = $_POST['REPASS'];
      $query = "SELECT PASSWORD FROM Customer WHERE ID=$id";
      $result = mysql_query($query);
      if(!$result){
        echo "<h1>Có lỗi xảy ra</h1>"; 
        echo "<h3>Không thể kết nối tới cơ sở dữ liệu. Quý khách xin vui lòng thử lại sau.2</h3>"; 
        echo "<a href='?page=return'>Ấn vào đây để quay trở lại</a>";
        echo mysql_error();
      }else{
        $row = mysql_fetch_array($result);
        $db_pass = $row['PASSWORD'];
        if($oldpass != $db_pass){
          echo "<h1>Có lỗi xảy ra</h1>"; 
          echo "<h3>Mật khẩu không chính xác. Vui lòng thử lại.</h3>"; 
          echo "<a href='?page=return'>Ấn vào đây để quay trở lại</a>";
        }else if($newpass == ""){
          echo "<h1>Có lỗi xảy ra</h1>"; 
          echo "<h3>Bạn chưa nhập mật khẩu mới. Vui lòng thử lại.</h3>"; 
          echo "<a href='?page=return'>Ấn vào đây để quay trở lại</a>";
        }else if($newpass != $repass){
            echo "<h1>Có lỗi xảy ra</h1>"; 
            echo "<h3>Mật khẩu không trùng khớp. Vui lòng thử lại.</h3>"; 
            echo "<a href='?page=return'>Ấn vào đây để quay trở lại</a>";
        }else{
          $enc_pass = md5(md5($newpass));
          $query = "UPDATE Customer SET `PASSWORD`='$enc_pass' WHERE ID=$id";
          $result = mysql_query($query);
          if(!$result){
            echo "<h1>Có lỗi xảy ra</h1>"; 
            echo "<h3>Không thể kết nối tới cơ sở dữ liệu. Quý khách xin vui lòng thử lại sau1.</h3>"; 
            echo "<a href='?page=return'>Ấn vào đây để quay trở lại</a>";
             echo mysql_error();
          }else{
            echo "<h1>Sửa đổi thành công</h1>";
            echo "<h3>Mật khẩu mới của bạn đã được lưu vào cơ sở dữ liệu.</h3>";
            echo "<a href='?page=account'><p>Ấn vào đây để quay trở lại</p></a>";
          }
        }
      }
      break;
    case 'change_info':
      $name = mysql_real_escape_string($_POST['NAME']);
      $email = mysql_real_escape_string($_POST['EMAIL']);
      $phone = mysql_real_escape_string($_POST['PHONE']);
      $mobile = mysql_real_escape_string($_POST['MOBILE']);
      $date = mysql_real_escape_string($_POST['DATE']);
      $month = mysql_real_escape_string($_POST['MONTH']);
      $year = mysql_real_escape_string($_POST['YEAR']);
      $DOB = "$date/$month/$year";
      $city = mysql_real_escape_string($_POST['CITY']);
      $address = mysql_real_escape_string($_POST['ADDRESS']);
      $gender = mysql_real_escape_string($_POST['GENDER']);
      $query = "UPDATE Customer SET `NAME`='$name',`EMAIL`='$email',`ADDRESS`='$address',
      `DOB`='$DOB',`CITY`='$city',`PHONE`='$phone',`GENDER`=$gender,
      `MOBILE`='$mobile' WHERE ID=$id";
      $result = mysql_query($query);
      if(!$result){
        echo "<h1>Có lỗi xảy ra</h1>"; 
        echo "<h3>Không thể kết nối tới cơ sở dữ liệu. Quý khách xin vui lòng thử lại sau.</h3>"; 
        echo "<a href='?page=return'>Ấn vào đây để quay trở lại</a>";
      }else{
        $_SESSION['name'] = $name;
        echo "<h1>Sửa đổi thành công</h1>"; 
        echo "<h3>Thông tin cá nhân của bạn đã được lưu vào cơ sở dữ liệu.</h3>"; 
        echo "<a href='?page=account'><p>Ấn vào đây để quay trở lại</p></a>";
      }
      break;

    default: returnPage_user();
   }
?>
</div>

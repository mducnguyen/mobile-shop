<head><script type="text/javascript" src="./scripts/jquery.js"></script>
<script type="text/javascript" src="./scripts/javascript.js"></script></head>
<?php
session_start();
@include("./includes/global.php");
@include("./includes/mysql.php");

if(isset($_GET['action'])){
  switch($_GET['action']){
    case "search":
      $search_str = strtolower($_GET['q']);
      if(!$search_str)
        return;
      $query = "SELECT NAME,THUMBNAIL FROM Product WHERE NAME like \"%$search_str%\"";
      $result = mysql_query($query);
      if(!$query || mysql_num_rows($result) == 0){
        echo "Không tìm thấy kết quả nào";
        return;
      }
      while($row = mysql_fetch_array($result)){
        $tensp = "<img src='".$row['THUMBNAIL']."' width=50 height=50 align='center' onError='ImgError(this)' />"."&nbsp;&nbsp;".$row['NAME'];
        echo "$tensp\n";
      }
    break; 

    case "set_phone":
      if(isset($_GET['id'])){
        $phoneid = $_GET['id'];
        echo $phoneid;
        $_SESSION['phone_compare'][$phoneid] = strtolower(mysql_real_escape_string($_GET['name'])); 
      }
    break;
    case "show":
      maketable(2); // Tạo bảng so sánh sản phẩm -> ./includes/global.php
    break;
    default: echo "Có lỗi xảy ra";
  }
}else{
  echo "Có lỗi xảy ra. Không tìm thấy sản phẩm nào.";
}

?>

<?
  if(!isset($_GET['type']) || $_GET['type'] == NULL) 
    returnPage_admin();
  switch($_GET['type']){
    case 'pagenotfound': $msg="Không tìm thấy trang bạn yêu cầu!"; break;
    case 'nopermission': $msg="Bạn không có đủ quyền để thực hiện chức năng này!"; break;
  }
?>
<h2>Có lỗi xảy ra: <?php echo $msg; ?></h2>
<a href="./?page=return">Nhấn vào đây để quay lại trang vừa truy cập</a>

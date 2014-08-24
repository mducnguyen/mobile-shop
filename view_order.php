<script type="text/javascript">
function payment_confirm(){
  $.ajax({
    type: 'POST',
    url: 'index.php?page=payment',
  });
}
</script>
<?
  if(!CheckLogin('customer')){
    echo "<h1>Có lỗi xảy ra</h1>";
    echo "<h3>Bạn phải đăng nhập trước khi thanh toán</h3>";
    echo "<a href='?page=login'>Ấn vào đây để đăng nhập</a>";
  }else if(!isset($_POST['delivery'])){
    header("location:?page=delivery");
  }else{
  unset($_SESSION['delivery']);
  $_SESSION['delivery'] = array();
  $_SESSION['delivery']['name'] = $_POST['name'];
  $_SESSION['delivery']['gender'] = $_POST['gender']?"Nam":"Nữ";
  $_SESSION['delivery']['email'] = $_POST['email'];
  $_SESSION['delivery']['phone'] = $_POST['phone'];
  $_SESSION['delivery']['mobile'] = $_POST['mobile'];
  $_SESSION['delivery']['city'] = $_POST['city'];
  $_SESSION['delivery']['address'] = $_POST['address'];
  $_SESSION['delivery']['note'] = isset($_POST['note'])?$_POST['note']:"";
  $_SESSION['delivery']['paymethod'] = $_POST['paymethod'];
  $delivery = $_SESSION['delivery'];
  $query = "SELECT * FROM Customer WHERE ID=".$_SESSION['userid'];
  $result = @mysql_query($query);
  $row = @mysql_fetch_array($result);
  extract($row);
  $GENDER = $GENDER?"Nam":"Nữ";
?>
<div class='block'>
  <h1>Thông tin vận chuyển</h1>
  <table style="width:100%">
    <tr>
      <td style="text-align:center">Người đặt hàng</td>
      <td style="text-align:center">Người nhận hàng</td>
    </tr>
    <tr>
      <td width="50%" style="font-weight: normal">
      <span style="font-weight:bolder">Họ và tên: </span><?echo $NAME;?><br />
      <span style="font-weight:bolder">Giới tính: </span><?echo $GENDER?><br />
      <span style="font-weight:bolder">Email: </span><?echo $EMAIL;?><br />
      <span style="font-weight:bolder">Điện thoại: </span><?echo $PHONE;?><br />
      <span style="font-weight:bolder">Di động: </span><?echo $MOBILE;?><br />
      <span style="font-weight:bolder">Thành phố: </span><?echo $CITY;?><br />
      <span style="font-weight:bolder">Địa chỉ: </span><?echo $ADDRESS;?><br />
      </td>
      <td width="50%" style="font-weight: normal">
      <span style="font-weight:bolder">Họ và tên: </span><?echo $delivery['name'];?><br />
      <span style="font-weight:bolder">Giới tính: </span><?echo $delivery['gender'];?><br />
      <span style="font-weight:bolder">Email: </span><?echo $delivery['email'];?><br />
      <span style="font-weight:bolder">Điện thoại: </span><?echo $delivery['phone'];?><br />
      <span style="font-weight:bolder">Di động: </span><?echo $delivery['mobile'];?><br />
      <span style="font-weight:bolder">Thành phố: </span><?echo $delivery['city'];?><br />
      <span style="font-weight:bolder">Địa chỉ: </span><?echo $delivery['address'];?><br />
      <span style="font-weight:bolder">Ghi chú: </span><?echo $delivery['note'];?><br />
      <span style="font-weight:bolder">Phương thức thanh toán: </span><?echo $delivery['paymethod'];?>
      </td>
    </tr>
  </table>
</div>
<div class='block'>
  <h1>Đơn hàng</h1>
<table style="width:100%">
<tr>
<td style="color: #000">Tên sản phẩm</td>
<td style="color: #000">Đơn giá (VNĐ)</td>
<td style="color: #000">Số lượng</td>
<td style="color: #000">Thành tiền (VNĐ)</td>
<?php
  $total = 0;
  $dssanpham = "";
  foreach($_SESSION['cart'] as $id => $product){
    extract($product);
    $price = $unitprice*$quantity;
    $total += $price;
    $unitprice = number_format($unitprice); // Display price in currency format
    $price = number_format($price); // Display price in currency format
    $dssanpham .="$name($quantity) ";
    echo "<tr>
            <td>$id - $name</td>
            <td>$unitprice</td>
            <td>$quantity</td>
            <td>$price</td> 
          </tr>";
  }
  $total = number_format($total);// Display price in currency format
  echo "<tr>
          <td colspan='3'><span style='color:red'>Tổng cộng</span></td>
          <td><span style='color:red'>$total</span></td>   
        </tr>";
  echo "<tr>
          <td align='center' colspan='4'>
            <a href='?page=delivery'><input type='button' name='goback' class='button' value='Quay lại' /></a>";
   if($delivery['paymethod'] == "Thanh toán với nganluong.vn"){   
     echo "<a target=\"_blank\" href=\"https://www.nganluong.vn/button_payment.php?receiver=nhom4.c1101l@gmail.com&product_name=Đơn đặt hàng - ĐTDD Online&price=$total&return_url=$site_url/?page=thank&comments=$dssanpham\" >
            <img align='top' onclick='payment_confirm()' style='border:0px' src=\"https://www.nganluong.vn/data/images/buttons/3.gif\" />
            </a>";
    }else if($delivery['paymethod'] == "Gửi tiền qua bưu điện"){
      echo " <a href='?page=thank'><input type='button' name='confirm' class='button' value='Xác nhận' onclick='payment_confirm()' /></a>";
    }
   echo "</td>
        <tr>";
?>
</table>
<? } ?>
</div>

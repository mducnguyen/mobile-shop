<?php
if(!CheckLogin("customer"))
  returnPage_user();
$query="SELECT * FROM  Customer where ID=".$_SESSION['userid'];
$result=mysql_query($query);

$rows=mysql_fetch_array($result)
?>
<div class="block">
  <h1>Thông tin đăng nhập</h1>
<table style="border-collapse:collapse; width:100%">
  <tr>
    <td width="30%">Tên đăng nhập</td>
    <td width="70%"><? echo $rows['USERNAME']; ?></td>
  </tr>
  <tr>
    <td>Mật khẩu</td>
    <td>*********</td>
  </tr>
    <tr>
    <td style="text-align:center" colspan="2">
<a href="?page=edit_account&action=change_pass"><input type="button" class="button" style="padding: 3px" name="btnEdit" value="Thay đổi mật khẩu" /></a>
</td>
  </tr>
</table>
  <h1>Thông tin cá nhân</h1>
<table style="border-collapse:collapse; width:100%">
  <tr>
    <td width="30%">Họ và tên</td>
    <td width="70%"><? echo $rows['NAME']; ?></td>
  </tr>
  <tr>
    <td>Giới tính</td>
    <td><?
    $gender = $rows['GENDER']?"Nam":"Nữ";
    echo $gender; ?>
</td>
  </tr>
  <tr>
    <td>Email</td>
    <td><? echo $rows['EMAIL']; ?></td>
  </tr>
  <tr>
    <td>Điện thoại</td>
    <td><? echo $rows['MOBILE']; ?></td>
  </tr>
  <tr>
    <td>Di động</td>
    <td><? echo $rows['PHONE']; ?></td>
  </tr>
  <tr>
    <td>Địa chỉ</td>
    <td><? echo $rows['ADDRESS']; ?></td>
  </tr>
      <td>Ngày sinh</td>
    <td><? echo $rows['DOB']; ?></td>
  </tr>
  <tr>
    <td>Thành phố</td>
    <td><? echo $rows['CITY']; ?></td>
  </tr>

  <tr>
    <td style="text-align:center" colspan="2">
<a href="?page=edit_account&action=change_info"><input type="button" class="button" style="padding: 3px" name="btnEdit" value="Chỉnh sửa" /></a>
</td>
  </tr>
  </table>
</div>

<div class='block'>
  <a name="history"><h1>Lịch sử giao dịch</h1></a>
  <?
    $query1 = "SELECT * FROM `Order` WHERE CUSTOMER_ID=".$_SESSION['userid'];
    $result1 = mysql_query($query1);
    if(!$result1 || mysql_num_rows($result1) == 0){
      echo "<h3>Bạn chưa thực hiện hoạt động mua bán nào trên website</h3>";
    }else{
      echo "<ul class=\"other_news\">";
      while($row1 = mysql_fetch_array($result1)){
        $orderid = $row1['ID'];
        $time = date("d/m/Y",$row1['TIME']);
        echo "<li><a href='#history' onclick=\"show_order('$orderid')\">Đơn hàng #$orderid</a> - <span style='color:#aaa'>[$time]</span></li>";
        ?>
        <div id='order<?echo $orderid;?>' style="display:none">
          <table style="width:100%">
<tr>
<td style="color: #000">Tên sản phẩm</td>
<td style="color: #000">Đơn giá (VNĐ)</td>
<td style="color: #000">Số lượng</td>
<td style="color: #000">Thành tiền (VNĐ)</td>
<?php
  $total = 0;
  $query2= "SELECT `OrderDetail`.`QUANTITY`, `OrderDetail`.`PRICE`,`Product`.`ID`, `Product`.`NAME` FROM `OrderDetail` 
            INNER JOIN `Product` ON `OrderDetail`.`PRODUCT_ID` = `Product`.`ID`
            WHERE `OrderDetail`.`ORDER_ID` = $orderid";
  $result2 = mysql_query($query2);
  while($row2 = mysql_fetch_array($result2)){
    extract($row2);
    $sumprice = $PRICE*$QUANTITY;
    $total += $sumprice;
    $PRICE = number_format($PRICE);
    $sumprice = number_format($sumprice);
    echo "<tr>
            <td>$ID - $NAME</td>
            <td>$PRICE</td>
            <td>$QUANTITY</td>
            <td>$sumprice</td> 
          </tr>";
  }
  $total = number_format($total);// Display price in currency format
  echo "<tr>
          <td colspan='3'><span style='color:red'>Tổng cộng</span></td>
          <td><span style='color:red'>$total</span></td>   
        </tr></table>";?>
        </div>
        <?
      }
      echo "</ul>";
    }
  ?>
</div>

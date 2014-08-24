<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
<?php 
if(!isset($_GET['id']) || $_GET['id'] == NULL)
  returnPage_admin();
$id = $_GET['id'];
?>
<div class="top-bar">
                    <h1>Xem đơn hàng</h1>
</div>
<h3>Đơn hàng #<?echo $id;?></h3>
<div class="table">
<table class="listing form" cellpadding="0" cellspacing="0">
<tr>
<th>Tên sản phẩm</th>
<th>Đơn giá (VNĐ)</th>
<th>Số lượng</th>
<th>Thành tiền (VNĐ)</th>
<?php
  $total = 0;
  $query2= "SELECT `OrderDetail`.`QUANTITY`, `OrderDetail`.`PRICE`,`Product`.`ID`, `Product`.`NAME` FROM `OrderDetail` 
            INNER JOIN `Product` ON `OrderDetail`.`PRODUCT_ID` = `Product`.`ID`
            WHERE `OrderDetail`.`ORDER_ID` = $id";
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
        </tr>";
    $query = "SELECT STATUS FROM `Order` WHERE ID=$id";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    $status = $row['STATUS'];
        echo "<tr>
          <td colspan='3'>Trạng thái</span></td>
          <td>$status <a href='?page=update_orderstatus&id=$id'><img src=\"img/edit-icon.gif\" width=\"16\" height=\"16\" alt=\"\" align='top' /></a></td>   
        </tr>";?>
</table>
</form>
</div>

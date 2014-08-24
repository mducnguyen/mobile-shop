<h1>Giỏ hàng</h1>
<form action="?page=cart_query&action=update" method="post">
<table style="width:100%">
<tr>
<th>Tên sản phẩm</th>
<th>Đơn giá (VNĐ)</th>
<th>Số lượng</th>
<th>Xóa</th>
<th>Thành tiền (VNĐ)</th>
<?php
  $total = 0;
  foreach($_SESSION['cart'] as $id => $product){
    extract($product);
    $price = $unitprice*$quantity;
    $total += $price;
    $unitprice = number_format($unitprice); // Display price in currency format
    $price = number_format($price); // Display price in currency format
    echo "<tr>
            <td>$id - $name</td>
            <td>$unitprice</td>
            <td><input type='text' value='$quantity' name='qty$id' size='2'/></td>
            <td><a href='?page=cart_query&action=delete&id=$id'>[ Xóa ]</a></td>       
            <td>$price</td> 
          </tr>";
  }
  $total = number_format($total);// Display price in currency format
  echo "<tr>
          <td colspan='4'><span style='color:red'>Tổng cộng</span></td>
          <td><span style='color:red'>$total</span></td>   
        </tr>";
  echo "<tr>
          <td align='right' colspan='5'>
            <input type='submit' name='update_cart' class='button' value='Cập nhật' />
            <a href='?page=products'><input type='button' name='tieptucmua' class='button' value='Tiếp tục mua hàng' /></a>
            <a href='?page=delivery'><input type='button' name='thanhtoan' class='button' value='Thanh toán' /></a>
          </td>
        <tr>";
?>
</table>
</form>

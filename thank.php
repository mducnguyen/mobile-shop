<div class='block'>
<?
  if(isset($_SESSION['payment']) && $_SESSION['payment'] == 'paid'){
    extract($_SESSION['delivery']);
    $customer_id = $_SESSION['userid'];
    $status = "Đã thanh toán";
    $query1 = "INSERT INTO `Order` (`CUSTOMER_ID`,`STATUS`,`PAYMETHOD`,`DEL_NAME`,`DEL_GENDER`,`DEL_EMAIL`,`DEL_PHONE`,`DEL_MOBILE`,`DEL_NOTE`,`DEL_CITY`,`DEL_ADDRESS`) 
    VALUES($customer_id,'$status','$paymethod','$name','$gender','$email','$phone','$mobile','$note','$city','$address')";
    $result1 = mysql_query($query1);
    $orderid = mysql_insert_id();
    foreach($_SESSION['cart'] as $id => $product){
      $quantity = $product['quantity'];
      $unitprice = $product['unitprice'];
      $query2 = "INSERT INTO `OrderDetail` (`ORDER_ID`,`PRODUCT_ID`,`QUANTITY`,`PRICE`) VALUES('$orderid','$id','$quantity','$unitprice')";
      $result2 = @mysql_query($query2);
      $query = "SELECT QUANTITY FROM Product WHERE ID=$id";
      $result = @mysql_query($query);
      $row = mysql_fetch_array($result);
      $old_quantity = $row['QUANTITY'];
      $new_quantity = $old_quantity - $quantity;
      $query = "UPDATE Product SET QUANTITY='$new_quantity' WHERE ID=$id";
      $result = @mysql_query($query);
      
    }
    if($result1){
      echo "<h1>Cảm ơn quý khách.</h1>";
      echo "<h3>Cảm ơn quý khách đã mua hàng tại website chúng tôi. Nếu có điều gì thắc mắc hoặc chưa hài lòng, quý khác xin vui lòng sử dụng
      chức năng liên hệ của website!</h3>";
      echo "<a href='?page=home'>Ấn vào đây để trở về trang chủ</a>";
      unset($_SESSION['cart']);
      unset($_SESSION['delivery']);
      unset($_SESSION['payment']);
    }else{
      //echo mysql_error();
    }
  }else{
    unset($_SESSION['payment']);
    header("location:?page=home");
  }
?>
</div>

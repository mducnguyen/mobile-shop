<div class='block'>
<?
$set_prev_page = 0;
function cart_add(){
  if(!isset($_GET['id']) || $_GET['id'] == ""){
    returnPage_user();
  }else{
    $id = mysql_real_escape_string($_GET['id']);
    if(!isset($_SESSION['cart']))
      $_SESSION['cart'] = array();
    // Check if the product is already in the shopping cart
    if(isset($_SESSION['cart'][$id])){
      $_SESSION['cart'][$id]['quantity'] += 1;
      $query = "SELECT NAME,QUANTITY FROM Product WHERE ID=$id";
      $result = @mysql_query($query);
      $row = mysql_fetch_array($result);
      $quantity = $row['QUANTITY'];
      $name = $row['NAME'];
      if($quantity - $_SESSION['cart'][$id]['quantity'] < 0){
        $_SESSION['cart'][$id]['quantity'] -= 1;
        echo "<h1>Có lỗi xảy ra</h1>";
        echo "<h3>Sản phẩm '$name' chỉ còn $quantity sản phẩm</h3>";
        echo "<a href='?page=return'>Ấn vào đây để quay lại</a>";
        return 0;
      }
    }else{
      // Get information from db for the product
      $query = "SELECT ID, NAME, THUMBNAIL, PRICE, QUANTITY FROM Product WHERE ID=$id";
      $result = @mysql_query($query);
      if(!$result){
        echo "<h1>Có lỗi xảy ra</h1>";
        echo mysql_error();
        return 0;
      }
      $row = mysql_fetch_array($result);
      extract($row);
      if($QUANTITY < 1){
        echo "<h1>Có lỗi xảy ra</h1>";
        echo "<h3>Sản phẩm '$NAME' đã hết hàng !</h3>";
        echo "<a href='?page=return'>Ấn vào đây để quay lại</a>";
        return 1;
      }      
      $_SESSION['cart'][$id] = array("name" => $NAME
                                    ,"unitprice" => $PRICE
                                    ,"thumbnail" => $THUMBNAIL
                                    ,"quantity" => 1);
    }
    returnPage_user();
  }
}

function cart_delete(){
  if(!isset($_GET['id']) || $_GET['id'] == ""){
    return 0;
  }else{
    $id = mysql_real_escape_string($_GET['id']);
    unset($_SESSION['cart'][$id]);
  }  
  header("location:?page=cart");
}

function cart_update(){
  if(!isset($_POST['update_cart']))
    returnPage_user();

  foreach($_POST as $key => $value){
    if(stristr($key,'qty')){
      $id = str_replace('qty','',$key); 
      $query = "SELECT NAME,QUANTITY FROM Product WHERE ID=$id";
      $result = @mysql_query($query);
      $row = mysql_fetch_array($result);
      $quantity = $row['QUANTITY'];
      $name = $row['NAME'];
      if($quantity - $value < 0){
        $_SESSION['cart'][$id]['quantity'] = $quantity;
        echo "<h1>Có lỗi xảy ra</h1>";
        echo "<h3>Sản phẩm '$name' chỉ còn $quantity sản phẩm. Chỉ có $quantity sản phẩm được thêm vào giỏ hàng</h3>";
        echo "<a href='?page=return'>Ấn vào đây để quay lại</a>";
        return 0;
      }
      $_SESSION['cart'][$id]['quantity'] = $value;
    }
  }
  header("location:?page=cart");
  return 1;
}

  if(isset($_GET['action'])){
    switch($_GET['action']){ 
      case 'add': cart_add(); break;
      case 'delete': cart_delete();break;
      case 'update': cart_update();break;
      default: returnPage_user();
    }
  }else{
    exit;
  }
  
?>
</div>

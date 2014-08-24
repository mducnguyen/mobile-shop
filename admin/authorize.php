<?
// The functionality of these function is to check if username and password in the database
function login($username, $password){
  $encpass = md5(md5($password)); // encrypted password
  // Get information from the database
  $login = "fail";
  $query = "SELECT * FROM Admin WHERE USERNAME='$username'";
  $result = mysql_query($query);
  if(!$result){ // Check if there are errors while sending query to the database
    return $login;
  }
  elseif(mysql_num_rows($result) == 0){ // Check if the username exists in database
    return $login;
  }
  $row = mysql_fetch_array($result);
  if($encpass != $row['PASSWORD'])
    return $login;
  else
    $login = "pass";

  if ($login == "pass"){
    $_SESSION['admin_name'] = $row['NAME'];
    $_SESSION['admin_username'] = $row['USERNAME'];
    $_SESSION['admin_id'] = $row['ID'];
    $admin_group = $row['GROUP_ID'];
    $query = "SELECT * FROM AdminGroup WHERE ID='$admin_group'";
    $result = mysql_query($query);
    if($result){
      $row = mysql_fetch_array($result);
      $_SESSION['admin_product'] = $row['PRODUCTS'];
      $_SESSION['admin_admin'] = $row['ADMINS'];
      $_SESSION['admin_customer'] = $row['CUSTOMERS'];
      $_SESSION['admin_order'] = $row['ORDERS'];
      $_SESSION['admin_news'] = $row['NEWS'];
      $_SESSION['admin_system'] = $row['SYSTEM'];
      $_SESSION['admin_feedback'] = $row['FEEDBACK'];
    }
  }
  return $login;
}
?>

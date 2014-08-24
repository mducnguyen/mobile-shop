<?
// The functionality of these function is to check if username and password in the database
function login($username, $password){
  $encpass = md5(md5($password)); // encrypted password
  // Get information from the database
  $login = "pass";
  $query = "SELECT * FROM Customer WHERE Username='$username'";
  $result = mysql_query($query);
  if(!$result){ // Check if there are errors while sending query to the database
    $login = "fail";
  }
  elseif(mysql_num_rows($result) == 0){ // Check if the username exists in database
    $login = "fail";
  }
  $row = mysql_fetch_array($result);
  if($encpass != $row['PASSWORD'])
    $login = "fail";

  if ($login == "pass"){
    $_SESSION['name'] = $row['NAME'];
    $_SESSION['username'] = $row['USERNAME'];
    $_SESSION['userid'] = $row['ID'];
  }
  return $login;
}
?>

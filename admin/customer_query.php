<?php
$set_prev_page = 0;
  $name = $_POST['NAME'];
  $username = $_POST['USERNAME'];
  $password = $_POST['PASSWORD'];
  $encpass = md5(md5($password));
  $email = $_POST['EMAIL'];
  $phone = $_POST['PHONE'];
  $mobile = $_POST['MOBILE'];
  $DOB = $_POST['DATE']."/".$_POST['MONTH']."/".$_POST['YEAR'];
  $city = $_POST['CITY'];
  $address = $_POST['ADDRESS'];
  $gender = $_POST['GENDER'];
  $query = "INSERT INTO Customer (`USERNAME`,`NAME`,`PASSWORD`,`EMAIl`,`ADDRESS`,`DOB`,`CITY`,`PHONE`,`GENDER`,`MOBILE`) VALUES('$username','$name','$encpass','$email','$address','$DOB','$city','$phone','$gender','$mobile')";
  $result = mysql_query($query);
  if(!$result){
    echo "Dang ki khong thanh cong. Thu lai lan sau!".mysql_error();
    unset($_POST['registered']);
  }else{
    echo "Account was successfully created!";
  }
?>

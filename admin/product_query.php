<?php
  $uploaded_image = 0;
  $set_prev_page = 0;
  if(!isset($_GET['action']) || $_GET['action'] == NULL)
    returnPage_admin();
  if(!isset($_POST['add_product']) && !isset($_POST['update_product']))
    returnPage_admin();
  include "upload_files.php";
  $name=$_POST["NAME"];
	$description=$_POST["DESCRIPTION"];		
	$quantity=$_POST["QUANTITY"]   ;
 	$price=$_POST["PRICE"];
	$guaranty=$_POST["GUARANTY"];
  $dimension=$_POST["DIMENSION"];
  $display_other=$_POST["DISPLAY_OTHER"];
  $thumbnail=$file_path; // variable from upload_file.php
  $offer=$_POST["OFFER"];		 
	$brandid=$_POST["BRANDID"];
  $osid=$_POST["OSID"];
  $displaysize=$_POST["DISPLAYSIZE"];
  $weight=$_POST["WEIGHT"];		
  $design=$_POST["DESIGN"];		 
	$camera=$_POST['CAMERA'];
	$videorecord=$_POST['VIDEORECORD'];
	$sound=$_POST['SOUND'];
  $g2=$_POST["2G"];		 
  $g3=$_POST["3G"];		 
  $cpu=$_POST["CPU"];	
	$edge=$_POST['EDGE'];
	$wifi=$_POST['WIFI'];
	$gps=$_POST['GPS'];
	$bluetooth=$_POST['BLUETOOTH'];
	$radio=$_POST['RADIO'];
	$ext=$_POST['EXT_MEMORY'];	 
  $int=$_POST["INT_MEMORY"];		 
  $network=$_POST["NETWORK"];		 
	$batteryinfo=$_POST["BATTERYINFO"];
	$usb=$_POST['USB'];
	$browser=$_POST['BROWSER'];	
	$camera_other=$_POST['CAMERA_OTHER'];
	$qwerty=$_POST['QWERTY'];
  $messaging=$_POST["MESSAGING"];
  $feature_other=$_POST['FEATURE_OTHER'];
  $java=$_POST['JAVA'];
  $date = time();
  if($_GET['action'] == 'add'){
    $query = "INSERT INTO Product(`DATEADD`,`NAME`,`DESCRIPTION`,`QUANTITY`,`PRICE`,`GUARANTY`,`THUMBNAIL`,`OFFER`,`BRAND_ID`,`OS_ID`,`DISPLAYSIZE`, `WEIGHT`,`DESIGN`,`DIMENSION`,`CAMERA`,`VIDEORECORD`,`SOUND`,`2G`,`3G`,`CPU`,`EDGE`,`WIFI`,`GPS`,`BLUETOOTH`,`RADIO`,
          `EXT_MEMORY`,`INT_MEMORY`,`JAVA`,`MESSAGING`,`DISPLAY_OTHER`,`FEATURE_OTHER`,`NETWORK`,`BATTERYINFO`,`USB`,`BROWSER`,`CAMERA_OTHER`,`QWERTY`)
            VALUES ('','$name','$description','$quantity','$price','$guaranty','$thumbnail','$offer','$brandid','$osid','$displaysize','$weight','$design','$dimension','$camera','$videorecord','$sound','$g2','$g3','$cpu','$edge','$wifi','$gps','$bluetooth','$radio',
            '$ext','$int','$java','$messaging','$display_other','$feature_other','$network','$batteryinfo','$usb','$browser','$camera_other','$qwerty')";
    $success_msg = "<h2>SUSSCESSFULLY INSERTED!!!</h2><h3><a href='?page=manage_product'>Nhấn vào đây để quay lại</a></h3>";
  }else if($_GET['action'] == 'update'){
    if(!isset($_GET['id']) || $_GET['id'] == NULL)
      returnPage_admin();
    $id = $_GET['id'];
    $query = "UPDATE Product SET `NAME`='$name',`DESCRIPTION`='$description',`QUANTITY`='$quantity',`PRICE`='$price',`GUARANTY`='$guaranty',`THUMBNAIL`='$thumbnail',`OFFER`='$offer',`BRAND_ID`='$brandid',`OS_ID`='$osid',`DISPLAYSIZE`='$displaysize', `WEIGHT`='$weight',`DESIGN`='$design',`DIMENSION`='$dimension',`CAMERA`='$camera',`VIDEORECORD`='$videorecord',`SOUND`='$sound',`2G`='$g2',`3G`='$g3',`CPU`='$cpu',`EDGE`='$edge',`WIFI`='$wifi',`GPS`='$gps',`BLUETOOTH`='$bluetooth',`RADIO`='$radio',
          `EXT_MEMORY`='$ext',`INT_MEMORY`='$int',`JAVA`='$java',`MESSAGING`='$messaging',`DISPLAY_OTHER`='$display_other',`FEATURE_OTHER`='$feature_other',`NETWORK`='$network',`BATTERYINFO`='$baterryinfo',`USB`='$usb',`BROWSER`='$browser',`CAMERA_OTHER`='$camera_other',`QWERTY`='$qwerty' WHERE ID = $id";
    $success_msg = "<h2>SUSSCESSFULLY UPDATED!!!</h2><h3><a href='?page=manage_product'>Nhấn vào đây để quay lại</a></h3>";
  }
  $result = mysql_query($query);
  if($result){
     echo $success_msg;
  }else{
    echo "FAILED:".mysql_error();
  }
?>

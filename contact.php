<h1>Gửi góp ý / trợ giúp</h1>
      <form action="?page=send_feedback" method="POST">
        <?php if(!CheckLogin('customer')){ // Kiem tra nguoi dung dang nhap chua?> 
        <p>
          <label>Tên <span style="color:red">*</span></label>
          <input name="NAME" type="text" size="30" />
          <label>Email <span style="color:red">*</span></label> 
          <input name="EMAIL" type="text" size="30" />
          <label>Điện thoại</label>
          <input name="PHONE" type="text" size="30" />
          <label>Địa chỉ</label>
          <input name="ADDRESS" type="text" size="30" />
        <? }else{ 
          $query = "SELECT * FROM Customer WHERE ID=".$_SESSION['userid'];
          $result = mysql_query($query);
          $row = mysql_fetch_array($result);
          ?>
          <label>Tên <span style="color:red">*</span></label>
          <input disabled="disabled" value="<?echo $row['NAME']?>" type="text" size="30" />
          <input name="NAME" value="<?echo $row['NAME']?>" type="hidden"/>
          <label>Email <span style="color:red">*</span></label> 
          <input disabled="disabled" value="<?echo $row['EMAIL']?>" type="text" size="30" />
          <input name="EMAIL" value="<?echo $row['EMAIL']?>" type="hidden"/>
          <label>Điện thoại</label>
          <input disabled="disabled" value="<?echo $row['PHONE']?>" type="text" size="30" />
          <input name="PHONE" value="<?echo $row['PHONE']?>" type="hidden" />
          <label>Địa chỉ</label>
          <input disabled="disabled" value="<?echo $row['ADDRESS']?>" type="text" size="30" />
          <input name="ADDRESS" value="<?echo $row['ADDRESS']?>" type="hidden" />
        <? } ?>
          <label>Nội dung <span style="color:red">*</span></label> 
          <textarea name="CONTENT" rows="6" cols="50"></textarea>
          <br />  
          <img id="captcha" src="./securimage/securimage_show.php" alt="CAPTCHA Image" />
          <br />
          <input type="text" style="margin-bottom: 3px; height: 20px" name="captcha_code" size="10" maxlength="6" /> <span style="color:red">*</span>
          <a href="#" onclick="document.getElementById('captcha').src = './securimage/securimage_show.php?' + Math.random(); return false">[ Đổi ]</a>
          <br />
          <input class="button" name="feedback_submit" style="padding: 3px 20px" type="submit" value="Gửi"/>
        </p>
      </form>
